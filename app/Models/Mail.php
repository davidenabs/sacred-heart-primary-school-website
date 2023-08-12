<?php

namespace App\Models;

use App\Events\Admin\SentMailEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    protected $fillable = ['to', 'from', 'subject', 'body', 'actionButton', 'attachments', 'status'];

    protected $dispatchesEvents = [
        'created' => SentMailEvent::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
