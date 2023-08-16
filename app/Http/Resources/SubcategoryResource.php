<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubcategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'subcategory_title' => $this->subcategory_title,
            'slug' => $this->slug,
            'created_date' => $this->created_at->diffForHumans(),
            'categories' => CategoryResource::collection($this->categories),
        ];
    }
}
