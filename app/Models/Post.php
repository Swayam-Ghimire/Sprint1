<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    //
    use HasFactory, Notifiable;

    protected $fillable = ['title', 'content', 'published_at', 'category_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public static function deleteImage(Post $post)
    {
        if ($post->images->isNotEmpty()) {
            foreach ($post->images as $image) {
                Storage::disk('public')->delete($image->path);
            }
            $post->images()->delete();
        }
    }
}
