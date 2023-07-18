<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SexualOrientation extends Model
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


    public function userDetails(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(UserDetail::class);
    }
}
