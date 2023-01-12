<?php

namespace App\Console\Commands;

use App\Mail\RechazarSolicitudMailable;
use App\Models\Publicacion;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SolicitudPendienteAvisos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'solicitudpendiente:avisos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cambiar el estado de las solicitudes que estuvieron pendientes por mas de 3 dias y enviar mail';

    /**
     * Execute the console command.
     *
     *
     *return void
     */
    public function handle()
    {
        $solicitudes = Solicitud::get()->where('estado_solicitud', 'Pendiente');
//        dd($solicitudes);
        foreach ($solicitudes as $solicitud) {
            $fecha = $solicitud->created_at;
            $fecha_actual = date('Y-m-d');
            $dias = (strtotime($fecha_actual) - strtotime($fecha)) / 86400;
            $dias = abs($dias);
            $dias = floor($dias);
            if ($dias > 3) {
                $solicitud->estado_solicitud = 'Rechazada';
                $solicitud->save();
                $solicitante = User::all()->where('id', $solicitud->id_usuario)->first();
                $publicacion = Publicacion::all()->where('id', $solicitud->id_publicacion)->first();
//                $propietario = User::all()->where('id', $solicitud->id_propietario)->first();
                $info = [
                    'solicitante' => $solicitante->name,
                    'titulo_pub' => $publicacion->titulo,
                ];
                $correo = new RechazarSolicitudMailable($info);
                Mail::to($solicitante->email)->send($correo);
            }
        }
    }
}
