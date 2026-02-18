<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $fillable = ['name'];

    protected $casts = ['created_at', 'updated_at'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public static function topCategories(): SupportCollection
    {
        return DB::table('posts as p')->select('c.name', DB::raw('COUNT(p.id) as post_count'))->join('categories as c', 'p.category_id', '=', 'c.id')->whereBetween('p.published_at', [now()->subDays(30), now()])->groupBy('c.name')->having('post_count', '>', 0)->get();
    }
}
