<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Management extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'role', 'bio', 'avatar', 'social_fb', 'social_tw', 'social_ig', 'social_ln'];
}
