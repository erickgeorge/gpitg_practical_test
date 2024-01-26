<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
    ];

    public function ratings()
    {
        return $this->hasMany(UserRating::class , 'product_id');   //RELATIONSHIP AS IN TASK 1 NUMBER 5
    } 
}

