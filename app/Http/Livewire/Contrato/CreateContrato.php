<?php

namespace App\Http\Livewire\Contrato;

use App\Models\Publicacion;
use App\Models\User;
use Livewire\Component;
use App\Models\Contrato;

class CreateContrato extends Component
{

    //definir todas las variables que se nombraron en el archivo create-contrato.blade.php
    public $nombre_pub;
    public $fechainicio;
    public $fechafin;
    public $recargodias;
    public $meses;
    public $recargomes;
    public $cuotas;
    public $terminos;

    public $totalSteps = 4;
    public $currentStep = 1;

    public function mount(){
        $this->currentStep = 1;
//        $this
    }

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

    public function render()
    {
        $contratos = Contrato::all();
        $publicaciones = Publicacion::get()->where('id_usuario',auth()->user()->id);
        $users = User::all();

        return view('livewire.contrato.create-contrato', compact('contratos', 'publicaciones', 'users'));
    }

    public function incrementarPaso(){
        $this->resetErrorBag();
        $this->resetValidation();
        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }
    public function decrementarPaso(){
        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function validateData(){

        if ($this->currentStep == 1) {
            $this->validate([
                'nombre_pub' => 'required',
            ]);
        }elseif ($this->currentStep == 2) {
            $this->validate([
                'fechainicio' => 'required',
                'fechafin' => 'required',
                'recargodias' => 'required',
            ]);
        }elseif ($this->currentStep == 3) {
            $this->validate([
                'meses' => 'required',
                'recargomes' => 'required',
                'cuotas' => 'required',
            ]);
        }
    }

    public function register(){
        $this->resetErrorBag();
//        dd($this->nombre_pub, $this->fechainicio, $this->fechafin, $this->recargodias, $this->meses, $this->recargomes, $this->cuotas, $this->terminos);
        $publicacion = Publicacion::where('id',$this->nombre_pub);
        //recuperar el titulo de la publicacion
//        dd($publicacion->first()->titulo_publicacion);
        Contrato::insert([
            'titulo_contrato' => $publicacion->first()->titulo_publicacion.' contrato',
            'descripcion_contrato' => $this->terminos,
            'tipo_contrato' => 1, //definido por el usuario
            'monto_contrato' => $publicacion->first()->precio_publicacion,
            'fecha_inicial_pago_contrato' => $this->fechainicio,
            'fecha_final_pago_contrato' => $this->fechafin,
            'porcentaje_aumento_contrato_restraso' => $this->recargodias,
            'porcentaje_aumento_contrato' => $this->recargomes,
            'periodo_aumento_contrato' => $this->meses,
            'retraso_maximo_pago_contrato' => $this->cuotas,
            'id_publicacion' => $publicacion->first()->id,
        ]);
        $this->reset();
//        $this->emit('alerta');
//        $this->currentStep = 1;
        //redireccionar a la vista de contratos.index
        return redirect()->route('contratos.index')->with('contrato', 'ok');
    }
}
