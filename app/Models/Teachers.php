<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Teachers extends Model
{

    protected $fillable = [
        'users_id',
        'license',
        'enrollment',
        'professional_tittle',
        'subjects_taught'
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}