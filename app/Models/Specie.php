<?php

namespace App\Models;

use App\Traits\HasManyPlantation;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Specie extends Model implements HasMedia
{
    use 
    HasFactory,
    HasManyPlantation,
    InteractsWithMedia
    ;

    protected $fillable = [
        'category_id',
        'scientific_name',
        'generic_name',
        'family',
        'description',
    ];

    // ==============================Relationship==================================================

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ============================== Accessor & Mutator ==========================================

    public function getFeaturedPhotoAttribute()
    {
        return $this->getFirstMedia('featured_photo')->getUrl('card');
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    // ========================== Custom Methods ======================================================

    //media convertion
    public function registerMediaCollections(): void
    {
        $this
        ->addMediaConversion('card')
        ->width(650)
        ->nonQueued();
    
    }
    
}