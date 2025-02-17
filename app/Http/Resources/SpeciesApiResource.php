<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpeciesApiResource extends JsonResource
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
            'label' => $this->generic_name." "."(".$this->scientific_name.")", 
            // 'featured_photo' => $this->featured_photo,
            'value' => $this->id,
            // 'generic_name' => $this->generic_name,
            // 'family' => $this->family,
            // 'description' => $this->description,
            // 'category' => $this->category->name,
            // 'created_at' => $this->created_at->toDateString(),
        ];
    }
}
