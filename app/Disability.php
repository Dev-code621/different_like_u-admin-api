<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
    ];

    //set name capitalize when get name
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function userDetails(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(UserDetail::class);
    }
}
