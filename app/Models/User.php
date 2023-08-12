<?php

namespace App\Models;

// use App\Models\Authorization\Role;

use App\Events\Admin\NewUserAddedEvent;
use App\Models\Blog\Post;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'password',
        'last_seen',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected $dates = [
        'last_seen'
    ];

    public function trashed()
    {
        return User::where('deleted_at', '!=', null)->exists();
    }

    public function isAdmin()
    {
        return 'ADM' === Auth::user()->role;
    }

    public function isAuthor()
    {
        return 'WRT' === Auth::user()->role;
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function scopeAdmin($query)
    {
        return $query->whereRole('ADM');
    }

    public function scopeWriter($query)
    {
        return $query->whereRole('WRT');
    }

    public function scopeUser($query)
    {
        return $query->whereRole('USR');
    }

    public function mails()
    {
        return $this->hasMany(Mail::class);
    }

    public function writerInfo()
    {
        return $this->hasOne(WriterInfo::class);
    }

    protected $dispatchesEvents = [
        'created' => NewUserAddedEvent::class,
    ];

}
