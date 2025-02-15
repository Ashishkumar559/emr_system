<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    // use HasFactory;
    protected $fillable = [
        'specialization',
        'contact',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
