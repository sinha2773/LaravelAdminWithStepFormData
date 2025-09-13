<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserResponse extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'question_answer'
    ];
}
