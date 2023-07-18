<?php

namespace App\Observers;

use App\Review;
use App\Mail\MerchantMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function created(Review $review)
    {
        if(!empty($review->business) && !empty($review->business->user)){

            $overall_score=$review->overall_score;
             $email=$review->business->user->email;

            if(!empty($email) && !empty($overall_score)){
                if($overall_score < 3){
                    $template='emails.NegativeReview';
                }
                else{
                    $template='emails.PositiveReview';
                }

                $subject='You got a new review.';

                $body = [
                    'overall_score'=>$overall_score,
                    'review_url'=>config('app.url').'/merchant-dash/business',
                ];

                 Mail::to($email)->send(new MerchantMail($body, $template,$subject));
            }
        }
        else{
            Log::debug("Email address is not found. Review ID = ".$review->id .". Business ID = ".$review->business_id);
        }
        //treated differently reason filter
        $treatedDifferentlyReason = trim(str_replace('"','',$review->treated_differently_reason));
        //if disability selected
        if ($review->treated_differently==1 && $treatedDifferentlyReason=="Disability"){
            //get disability id what user selected
            $disabilityId = DB::table('disabilities')->where('name',strtolower(trim(str_replace('"','',$review->similarity_reason))))->pluck('id')->first();
            //get user detail id
            $userDetailId = $review->user->userDetail()->pluck('id')->first();
            //user don't save any disability then save disability to that user
            if ($disabilityId && $userDetailId && DB::table('disability_user_detail')->where('user_detail_id',$userDetailId)->count()==0){
                DB::table('disability_user_detail')->insert(['user_detail_id'=>$userDetailId,'disability_id'=>$disabilityId,'last_modified'=>now()]);
            }
        }
    }

    /**
     * Handle the Review "updated" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function updated(Review $review)
    {
        //
    }

    /**
     * Handle the Review "deleted" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function deleted(Review $review)
    {
        //
    }

    /**
     * Handle the Review "restored" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function restored(Review $review)
    {
        //
    }

    /**
     * Handle the Review "force deleted" event.
     *
     * @param  \App\Review  $review
     * @return void
     */
    public function forceDeleted(Review $review)
    {
        //
    }
}
