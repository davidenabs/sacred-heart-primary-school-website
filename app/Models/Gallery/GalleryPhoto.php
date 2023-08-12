<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['gallary_id', 'photo'];

    public function gallery()
    {
        return $this->belongsTo(Category::class);
    }
}
