<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $table = 'plataforms';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Relationships
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
