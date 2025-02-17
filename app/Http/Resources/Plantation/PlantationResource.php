<?php

namespace App\Http\Resources\Plantation;

use Illuminate\Http\Resources\Json\JsonResource;

class PlantationResource extends JsonResource
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
            'no_accessions' => $this->no_accessions,
            'species' => $this->location->specie->generic_name,
            'scientific_name' => $this->location->specie->scientific_name,
            'family_name' => $this->location->specie->family,
            'accesion_no' => $this->location->plant_uniqid,
            'collection_date' => $this->collection_date,
            'collection_place' => $this->location->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'seeds' => $this->seeds,
            'seedlings' => $this->seedlings,
            'wildlings' => $this->wildlings,
            'cuttings' => $this->cuttings,
            'marcotted' => $this->marcotted,
            'total_propagation' => $this->seeds+ $this->seedlings + $this->wildlings + $this->cuttings +$this->marcotted,
            'plantation_site' => $this->plantation_site,
            'code' => $this->code
            // 'created_at' => $this->created_at->toDateString(),
        ];
    }
}