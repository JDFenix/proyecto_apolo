<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'teachers_id'
    ];

    protected $table = 'user_teacher';
}

