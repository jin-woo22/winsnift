<?php

namespace App\Http\Livewire;
use App\Models\Location as PlantModel;

use Livewire\Component;

class Plant extends Component
{
    public $plants = [];
    public $plant_selected;

    public function loadPlant($id){
        $this->plant_selected = PlantModel::find($id);
        $this->dispatchBrowserEvent('contentChanged', ['lat' => $this->plant_selected->latitude, 'lng' => $this->plant_selected->longitude]);
    }

    public function mount(){
        $this->plants = PlantModel::all();
    } 

    public function render()
    {
        return view('livewire.plant');
    }
}
