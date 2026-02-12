<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category name' => $this->name,
            'posts' => $this->posts->map(function ($post) {
                return [
                    'title' => $post->title,
                    'content' => $post->content,
                ];
            }),
        ];
    }
}
