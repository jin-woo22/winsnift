<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantation extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'collection_date', 
        'latitude',
        'longitude',
        'planted_at',
        'seeds',
        'seedlings',
        'wildlings',
        'cuttings',
        'marcotted',
        'plantation_site',
        'code',
        'no_accessions'
    ];

    // ==============================Relationship==================================================

    public function specie()
    {
        return $this->belongsTo(Specie::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    
}
