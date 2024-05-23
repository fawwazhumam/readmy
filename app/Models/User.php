<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'First_Name',
        'Last_Name',
        'Date',
        'Gender',
        'Role',
        'Bio',
        'Address',
        'File_Name',
        'Header_File_Name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
    
    public function savedBooks()
    {
        return $this->belongsToMany(File::class, 'saved_books')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    public function getFollowersCountAttribute()
    {
        return $this->followers()->count();
    }

    public function getFollowingsCountAttribute()
    {
        return $this->followings()->count();
    }

    public function totalLikes(): int
    {
        return $this->files()->withCount('likes')->get()->sum('likes_count');
    }
}