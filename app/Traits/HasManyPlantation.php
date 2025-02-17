<?php 

namespace App\Traits;

use App\Models\Plantation;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyPlantation {

    public function plantions(): HasMany
    {
        return $this->hasMany(Plantation::class);
    }
}