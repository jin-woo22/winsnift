<?php

namespace App\Http\Resources\Specie;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecieResource extends JsonResource
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
            // 'featured_photo' => $this->featured_photo,
            'scientific_name' => $this->scientific_name,
            'generic_name' => $this->generic_name,
            'family' => $this->family,
            'description' => $this->description,
            'category' => $this->category->name,
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}