<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'slug',
        'is_published',
        'published_at',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'contentLimit' => 'string',
        ];
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function contentLimit(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Str::limit($this->content, 100),
        );
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => asset('storage/' . $value),
        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
