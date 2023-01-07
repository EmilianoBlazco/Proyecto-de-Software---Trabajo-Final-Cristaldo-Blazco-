<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Google\Cloud\Vision\VisionClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FacturasController extends Controller
{


    public function validarFactura(Request $request)
    {

        $imagen = $request->file('imagen');
        $vision = new VisionClient([
            'keyFile' => json_decode(file_get_contents(storage_path('app/key.json')), true),
        ]);
        $image = $vision->image(file_get_contents($imagen), ['TEXT_DETECTION']);

        $result = $vision->annotate($image);
        $texto = $result->text();

        $pagado = null;


//        si texto es distinto de null
        if(isset($texto[0])){
            $texto = $texto[0]->description();
            $texto = str_replace("\r\n", "\n", $texto);


//        si el logo es de mercado pago
            if(str_contains(strtolower($texto), "mercado") && str_contains(strtolower($texto), "pago")){
                if (str_contains(strtolower($texto), "pagado") || str_contains(strtolower($texto), "factura pagada" || str_contains(strtolower($texto), "Total pagado") || str_contains(strtolower($texto), "comprobante de pago"))) {
                    $pagado = true;
//                echo "pagado";
                }else {
//                echo "no pagado";
                    $pagado = false;
                }
            }


//        si el logo es de Energia de Misiones
            if (str_contains(strtolower($texto),"energÍa") && str_contains(strtolower($texto),"de misiones")){
                if (substr_count(strtolower($texto), "liquidación de servicios públicos") == 3){
                    $pagado = false;
                }else{
                    $pagado = true;
                }
            }
        }

        Session::flash('pagado', $pagado);

        $publicacion = Publicacion::find($request->id_publicacion);

        return redirect()->route('publicaciones.show', compact('publicacion'));

    }
}
