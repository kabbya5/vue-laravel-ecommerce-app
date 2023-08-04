<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'category_title' => $this->category_title,
            'slug' => $this->slug,
            'category_img' => $this->category_img,
            'category_text' => $this->category_text,
            'created_date' => $this->created_at->diffForHumans(),
        ];
    }
}
