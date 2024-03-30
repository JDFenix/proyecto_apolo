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

  
    public function advisories()
    {
        return $this->hasMany(Advisory::class, 'teachers_id');
    }

        
    
}