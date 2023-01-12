<?php

namespace App\Http\Livewire\Contrato;

use App\Models\Contrato;
use Livewire\Component;

class IndexContrato extends Component
{

    public $buscar;
//    public $contrato;

    public function render()
    {
        $contratos = Contrato::where('titulo_contrato', 'like', '%' . $this->buscar . '%')->get();

        return view('livewire.contrato.index-contrato', compact('contratos'));
    }

//    public function showContrato($id){
//        $this->dispatchBrowserEvent('show-modal');
//        $contrato = Contrato::find($id);
//        $this->emit('showContrato', $contrato);
//    }

    public function showModal(Contrato $id){
        $this->emit('showModal', $id);
    }

    public function eliminarContrato($id){
        $contrato = Contrato::find($id);
        $contrato->delete();
        session()->flash('message', 'Contrato eliminado correctamente');
    }

    public function limpiar(){
        $this->buscar = '';
    }
}
