<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;
    protected $fillable = [
     
        'diagnosis', 
        'symptoms', 
        'contact', 
        'blood_group', 
        'address',
        'patient_id',
        'doctor_id',
    ];
}
