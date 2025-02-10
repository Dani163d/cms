<?php
// app/Models/Career.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'duration',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}