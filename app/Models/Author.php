<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'username',
        'slug',
        'occupation',
        'avatar'];

    public function setNameAttribute($value)
    {
        $this->attributes['username'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
