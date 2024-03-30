<?php

namespace App\Models;

use App\Models\Teachers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advisory extends Model
{

    protected $fillable = [
        'tittle',
        'status',
        'subject',
        'date',
        'time',
        'teachers_id'
    ];

    use HasFactory;


   public function teacher(){
    return $this->belongsTo(User::class, 'teachers_id');
}


   
}
