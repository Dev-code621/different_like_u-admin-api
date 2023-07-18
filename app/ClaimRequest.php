<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'google_id',
        'name',
        'about',
        'image',
        'links',
        'other_link',
        'user_id',
        'claimed',
        'reason_rejected',
        'claimed_on',
    ];

    protected $table = 'businesses';

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function businessProof(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BusinessProof::class,'business_id', 'id');
    }
}
