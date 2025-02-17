<?php

namespace App\Models;

use App\Traits\HasManyPlantation;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model implements HasMedia
{
    use HasFactory, HasManyPlantation, InteractsWithMedia;

    protected $fillable = [
        'id',
        'name',
        'specie_id',
        'plant_uniqid',
        'latitude',
        'longitude',
        'image'
    ];

    // ==============================Relationship==================================================

    // public function category(): BelongsTo
    // {
    //     return $this->belongsTo(Category::class);
    // }

    public function specie()
    {
        return $this->belongsTo(Specie::class);
    }

    public function getWholeName(){
        return $this->specie->generic_name + "(" + $this->specie->scientific_name + ")";
    }

    //custom method
        //media convertion
        public function registerMediaCollections(): void
        {
            $this
            ->addMediaConversion('card')
            ->width(650)
            ->nonQueued();
        
        }
}