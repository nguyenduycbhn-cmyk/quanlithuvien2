<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
protected $fillable = [
    'user_name',
    'book_name',
    'borrow_date',
    'return_date'
];
}
