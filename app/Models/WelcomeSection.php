<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WelcomeSection extends Model
{
    protected $fillable = ['section_name', 'title', 'content', 'additional_data'];

    protected $casts = [
        'additional_data' => 'array'
    ];
}

