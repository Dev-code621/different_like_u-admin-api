<?php
namespace App\Helpers;

use App\Business;
use App\InclusiveScoreQaPoint;
use App\Preference;
use App\Review;
use App\Scoring;
use Illuminate\Support\Facades\Storage;

class Helper
{
    static function getPrivateBucket($file){
        if(!empty($file)){
            $client = Storage::disk('s3')->getDriver()->getAdapter()->getClient();
            $bucket = \Config::get('filesystems.disks.s3.bucket');

            $command = $client->getCommand('GetObject', [
                'Bucket' => $bucket,
                'Key' => $file  // file name in s3 bucket which you want to access
            ]);

            $request = $client->createPresignedRequest($command, '+20 minutes');

            // Get the actual presigned-url
            return $presignedUrl = (string)$request->getUri();
        }
        return null;
    }

    static function getAvatarPlaceholder(){
        return asset('images/avatar_placeholder.jpg');
    }

    static function getBackgroundPlaceholder(){
        return asset('images/whitebackogroudPlaceholder.png');
    }

    static function getThumbnailPlaceholder(){
        return asset('images/thumbnail-placeholder.jpg');
    }


    /**
     * set business inclusive score
     * @param int $businessId optional
     */
    static function setBusinessScores($businessId=0){
        $where = [];
        if ($businessId){
            $where = ['business_id'=>$businessId];
        }
        $reviewsByBusiness = Review::with([
            'user.userDetail',
            'user.userDetail.allyGroups',
            'user.userDetail.sexualOrientations',
            'user.userDetail.genders',
            'user.userDetail.race',
            'user.userDetail.ethnicity',
            'user.userDetail.appearance',
            'user.userDetail.languageProficiency',
            'user.userDetail.ageRange',
            'user.userDetail.disabilities',
        ])
          ->where($where)
          ->get()
          ->groupBy('business_id');

        $keys = [
            'allyGroups',
            'sexualOrientations',
            'genders',
            'race',
            'ethnicity',
            'appearance',
            'languageProficiency',
            'ageRange',
            'disabilities',
        ];

        $preferences = Preference::get(['code']);
        $inclusiveScoreQaPoints = InclusiveScoreQaPoint::get(['key','value','points']);

        $reviewsByBusiness->map(function ($reviews, $business_id) use ($keys, $preferences, $inclusiveScoreQaPoints) {
            //get criteria wise code and score
            $reviews = Review::getCodeNScore($reviews,$keys, $inclusiveScoreQaPoints);
            //update average inclusive score on business
            Business::where('id', $business_id)->update(['avg_inclusive_score' => $reviews->avg('inclusive_score')]);
            //add or update criteria wise scores
            Scoring::addUpdateScore($reviews,$preferences);
        });
    }
}