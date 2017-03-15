<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'seller_id',
        'status_id',
        'name',
        'price',
        'photo',
        'amount_by_package',
        'package_amount',
        'description'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    // Relationships
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function status()
    {
        return $this->belongsTo(ProductStatus::class,'status_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
