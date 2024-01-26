<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'rating_datetime',
    ];

    protected $casts = [
        'rating_datetime' => 'datetime',
    ];

    public function user()   //RELATIONSHIP AS IN TASK 1 NUMBER T
    {
        return $this->belongsTo(User::class);
    }

    public function product()   //RELATIONSHIP AS IN TASK 1 NUMBER T
    {
        return $this->belongsTo(Product::class);
    }
}
