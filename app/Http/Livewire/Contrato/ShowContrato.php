<?php

namespace App\Http\Livewire\Contrato;

use App\Models\Contrato;
use Livewire\Component;

class ShowContrato extends Component
{

    public $showModal = 'hidden';
//    public $contratos;

//    public function mount(Contrato $contrato){
//        $this->contratos = $contrato;
//    }

    protected $listeners = [
        'showModal'
    ];
    public function showModal(Contrato $contrato){
        $this->showModal = '';
    }

    public function closeModal(){
        $this->showModal = 'hidden';
    }

//    public function showContrato(){
//        $this->dispatchBrowserEvent('show-modal');
////        $contrato = Contrato::find($id);
////        $this->emit('showContrato', $contrato);
//    }

    public function render()
//    {
//        $this->contratos = Contrato::find($id);
//        dd($this->contratos);
//        return view('livewire.contrato.show-contrato', compact('contratos'));
//    }
    {

        return view('livewire.contrato.show-contrato');
    }
}
