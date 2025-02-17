<?php

namespace App\Http\Livewire;
use App\Models\Plantation as PlantationModel;

use Livewire\Component;

class Plantation extends Component
{
    public $plantations=[];
    public $plantation_selected;

    public function loadPlantation($id){
        $this->plantation_selected = PlantationModel::find($id);
        $this->dispatchBrowserEvent('contentChanged', ['lat' => $this->plantation_selected->longitude, 'lng' => $this->plantation_selected->latitude]);
        
    }

    public function mount(){
        $this->plantations = PlantationModel::all();
        
    }
    
    public function render()
    {
        return view('livewire.plantation');
    }
}
