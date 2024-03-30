<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $fillable =
    [
        'users_id',
        'enrollment',
        'career'
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function user_advisory()
    {
        return $this->hasMany(user_advisories::class, 'student_id');
    }
}
