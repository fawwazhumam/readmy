<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'Title',
        'Category',
        'Desc',
        'Type',
        'File_Name',
        'user_id',
        'likes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function savedByUsers()
    {
        return $this->belongsToMany(User::class, 'saved_books')->withTimestamps();
    }

    public function getBookmarksCountAttribute()
    {
        return $this->savedByUsers()->count();
    }
}
