<?php

namespace App\Http\Controllers;
use App\Models\CaracteristicaComodidad;
use App\Models\Ciudad;
use App\Models\Comodidad;
use App\Models\Provincia;
//use App\Models\PublicacionTipoInquilino;
use App\Models\Publicacion;
use App\Models\TipoInquilino;
use App\Models\TipoPropiedad;
use Google\Cloud\Core\Exception\GoogleException;
use Google\Cloud\Vision\VisionClient;
use Illuminate\Http\Request;


class PruebaController
{

    public function index()
    {
        $tiposPropiedad = TipoPropiedad::get();
        $comodidades = Comodidad::get();
        $caracteristicasComodidades = CaracteristicaComodidad::get();
        $tipoInquilino = TipoInquilino::get();



        return view('pruebaModal', compact('tiposPropiedad', 'comodidades', 'caracteristicasComodidades', 'tipoInquilino'));
    }



    public function enviarMensaje(Request $request)
    {
        $token = 'bot5876041532:AAGIc6Kx798La_gGaJkr2Q4AfecF7u52F4E';
        $chat_id = '5718728976';
//        $chat_id = '5676225575';
//        sacar del input con el nombre ""
        $mensaje = $request->input('mensaje');

        $this->enviarMensajeTelegram($chat_id, $mensaje, $token);

        return to_route('prueba.index')->with('success', 'Mensaje enviado');
    }



//    Función para enviar un mensaje con el bot de Telegram
    function enviarMensajeTelegram($chatID, $messaggio, $token,&$k = ''){
        $url = "https://api.telegram.org/" . $token . "/sendMessage?disable_web_page_preview=false&parse_mode=HTML&chat_id=" . $chatID;

//        if(isset($k)) {
//            $url = $url."&reply_markup=".$k;
//        }

        $url = $url."&text=" . urlencode($messaggio);
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
    }

}
