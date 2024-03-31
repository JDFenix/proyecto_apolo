<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_advisories extends Model
{
    use HasFactory;

    protected $fillable= [
        'advisory_id',
        'student_id'
    ];

    public function student()
    {
        return $this->hasOne(Students::class, 'users_id');
    }
}
