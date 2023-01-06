<?php

namespace App\Http\Controllers;
use App\Models\CaracteristicaComodidad;
use App\Models\Ciudad;
use App\Models\Comodidad;
use App\Models\Provincia;
//use App\Models\PublicacionTipoInquilino;
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

        $pagado = null;

//        $token = 'bot5876041532:AAGIc6Kx798La_gGaJkr2Q4AfecF7u52F4E';
////        $data = file_get_contents("php://input");
//
//        $this->enviarMensajeTelegram('5718728976', 'Hola como estás todo bien', $token);

        return view('pruebaModal', compact('tiposPropiedad', 'comodidades', 'caracteristicasComodidades', 'tipoInquilino', 'pagado'));
    }

    /**
     * @throws GoogleException
     */
    public function extraerTexto(Request $request)
    {
        $imagen = $request->file('imagen');
//        extraer el texto de la imagen y enviarlo a la vista para que se muestre en un textarea. Utiliazando la API de Google Cloud Vision
        $vision = new VisionClient([
            'keyFile' => json_decode(file_get_contents(storage_path('app/key.json')), true),
        ]);
        $image = $vision->image(file_get_contents($imagen), ['TEXT_DETECTION']);

//        ir separando el texto por saltos de linea y enviarlo a la vista para que se muestre en un textarea
        $result = $vision->annotate($image);
        $texto = $result->text();
        $texto = $texto[0]->description();
        $texto = str_replace("\r\n", "\n", $texto);


        $pagado = false;

//        si el logo es de mercado pago
        if(str_contains($texto, 'mercado pago')){
            if (str_contains($texto, 'pagado') || str_contains(strtolower($texto), 'factura pagada' || str_contains(strtolower($texto), 'total pagado') || str_contains(strtolower($texto), 'comprobante de pago'))) {
                $pagado = true;
            }
        }

//        si el logo es de Energia de Misiones
        if (str_contains(strtolower($texto),'energía de misiones')){
            if (substr_count(strtolower($texto), 'liquidación de servicios públicos') == 2){
                $pagado = false;
            }else{
                $pagado = true;
            }
        }
//        dd($pagado);

        return view('pruebaModal', compact('texto', 'pagado'));
    }

//    public function enviarMensaje(Request $request)
//    {
//        $token = 'bot5876041532:AAGIc6Kx798La_gGaJkr2Q4AfecF7u52F4E';
//        $chat_id = '5718728976';
////        $chat_id = '5676225575';
////        sacar del input con el nombre ""
//        $mensaje = $request->input('mensaje');
//
//        $this->enviarMensajeTelegram($chat_id, $mensaje, $token);
//
//        return to_route('prueba.index')->with('success', 'Mensaje enviado');
//    }
//
//
//
////    Función para enviar un mensaje con el bot de Telegram
//    function enviarMensajeTelegram($chatID, $messaggio, $token,&$k = ''){
//        $url = "https://api.telegram.org/" . $token . "/sendMessage?disable_web_page_preview=false&parse_mode=HTML&chat_id=" . $chatID;
//
////        if(isset($k)) {
////            $url = $url."&reply_markup=".$k;
////        }
//
//        $url = $url."&text=" . urlencode($messaggio);
//        $ch = curl_init();
//        $optArray = array(
//            CURLOPT_URL => $url,
//            CURLOPT_RETURNTRANSFER => true
//        );
//        curl_setopt_array($ch, $optArray);
//        $result = curl_exec($ch);
//        curl_close($ch);
//    }

}
