<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_name',
        'race_id',
        'age_range_id',
        'age_range_last_modified',
        'income_range_id',
        'income_range_last_modified',
        'ethnicity_id',
        'ethnicity_last_modified',
        'appearance_id',
        'appearance_last_modified',
        'language_proficiency_id',
        'language_proficiency_last_modified',
        'image',
        'notification'
    ];

    use HasFactory;

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function genders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Gender::class, 'gender_user_detail', 'user_detail_id', 'gender_id')->withPivot('last_modified');
    }

    public function sexualOrientations(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(SexualOrientation::class, 'sexual_orientation_user_detail', 'user_detail_id', 'sexual_orientation_id')->withPivot('last_modified');
    }

    public function allyGroups(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(AllyGroup::class, 'ally_group_user_detail', 'user_detail_id', 'ally_group_id')->withPivot('last_modified');
    }

    public function disabilities(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Disability::class, 'disability_user_detail', 'user_detail_id', 'disability_id')->withPivot('last_modified');
    }

    public function incomeRange(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(IncomeRange::class, 'income_range_id');
    }

    public function ageRange(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AgeRange::class, 'age_range_id');
    }

    public function languageProficiency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LanguageProficiency::class, 'language_proficiency_id');
    }

    public function appearance(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Appearance::class, 'appearance_id');
    }

    public function ethnicity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Ethnicity::class, 'ethnicity_id');
    }

    public function race(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Race::class, 'race_id');
    }
}
