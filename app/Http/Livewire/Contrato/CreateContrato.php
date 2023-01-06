<?php

namespace App\Http\Livewire\Contrato;

use App\Models\Publicacion;
use App\Models\User;
use Livewire\Component;
use App\Models\Contrato;

class CreateContrato extends Component
{

//    public $prueba;
//    public $titulo_contrato;
//    public $descripcion_contrato;
//    public $fecha_inicio_contrato;
//    public $fecha_vencimiento_contrato;
//    public $monto_contrato;
//    public $fecha_inicial_pago_contrato;
//    public $fecha_final_pago_contrato;
//    public $porcentaje_aumento_contrato;
//    public $periodo_aumento_contrato;
//    public $retraso_maximo_pago_contrato;
//    //public $id_publicacion;
//    public $id_forma_pago;

//    public $publicacion;
//
//    public function mount($publicacion){
//        $this->publicacion = $publicacion;
//    }

    public function render()
    {
        $contratos = Contrato::all();
        $publicaciones = Publicacion::all();
        $users = User::all();

        return view('livewire.contrato.create-contrato', compact('contratos', 'publicaciones', 'users'));
    }
}
