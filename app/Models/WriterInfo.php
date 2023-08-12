<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WriterInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'bio', 'birthday', 'facebook', 'twitter', 'profile'
    ];
}
