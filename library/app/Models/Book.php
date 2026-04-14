<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'category',
        'author',
        'publisher',
        'quantity',
        'price',
        'image'
    ];
}