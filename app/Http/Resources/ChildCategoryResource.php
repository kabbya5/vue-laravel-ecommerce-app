<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildCategoryResource extends JsonResource
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
            'childcat_title' => $this->childcat_title,
            'slug' => $this->slug,
            'created_date' => $this->created_at->diffForHumans(),
            'subcategories' => SubcategoryResource::collection($this->subcategories),

        ];
    }
}
