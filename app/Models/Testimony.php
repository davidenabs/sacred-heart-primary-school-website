<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'name',
        'occupation',
        'review', 'is_approve'
    ];

    protected static function booted()
    {
        static::addGlobalScope('published', function (Builder $builder) {
            if (!auth()->user()) {
                $builder->where('is_approve', true);
            }
        });
    }
}
