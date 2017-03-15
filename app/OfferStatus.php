<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OfferStatus extends Model
{
    protected $table = 'offer_status';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Relationships
    public function offers()
    {
        return $this->hasMany(Offer::class,'status_id');
    }
}
