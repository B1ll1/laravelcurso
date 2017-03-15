<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'buyer_id',
        'status_id',
        'total',
        'amount'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // Relationships
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function status()
    {
        return $this->belongsTo(OfferStatus::class,'status_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
