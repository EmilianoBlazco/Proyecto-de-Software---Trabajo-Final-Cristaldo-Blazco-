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
//            'key' => config('services.google.cloud_vision.key'),
        ]);
        $image = $vision->image(file_get_contents($imagen), ['TEXT_DETECTION']);

//        ir separando el texto por saltos de linea y enviarlo a la vista para que se muestre en un textarea
        $result = $vision->annotate($image);
        $texto = $result->text();
        $texto = $texto[0]->description();
        $texto = str_replace("\r\n", " ", $texto);

//        si se encuentra la palabra "pagado, factura pagada" en el texto, se debe enviar un booleano a la vista para que se muestre un checkbox ignorar mayusculas y minusculas
        $pagado = false;

//        si el logo es de mercado pago
        if(str_contains(strtolower($texto), 'mercado pago')){
            if (str_contains(strtolower($texto), 'pagado') || str_contains(strtolower($texto), 'factura pagada' || str_contains(strtolower($texto), 'total pagado') || str_contains(strtolower($texto), 'comprobante de pago'))) {
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




        return view('pruebaModal', compact('texto', 'pagado'));
    }

}
