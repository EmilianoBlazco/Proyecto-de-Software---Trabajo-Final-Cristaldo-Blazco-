<?php

namespace App\Http\Livewire\Contrato;

use App\Models\Contrato;
use Livewire\Component;

class IndexContrato extends Component
{

    public $buscar;

    public function render()
    {
        $contratos = Contrato::where('titulo_contrato', 'like', '%' . $this->buscar . '%')->get();

        return view('livewire.contrato.index-contrato', compact('contratos'));
    }
}
