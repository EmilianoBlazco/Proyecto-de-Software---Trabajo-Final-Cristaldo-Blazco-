<?php

use App\Http\Controllers\Admin\AuditoriaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\OCRController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\WebHooksController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicacionController;
use App\Http\Controllers\CharjsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//DB::listen(function($query){
//    //Imprimimos la consulta ejecutada
//    echo " {$query->sql }";
//});



//Pagina de Inicio
Route::view('/','welcome')->name('inicio');

//Prueba OCR
Route::get('/ocr', [OCRController::class, 'ocr'])->name('ocr');
Route::post('/upload', [OCRController::class, 'upload'])->name('upload');

//Pagina de Graficos
Route::get('/admin/graficos',[CharjsController::class,'grafClientes'])->name('admin.graficos');


//Pagina Borrado de Publicaciones
Route::get('/publicaciones/borrado',[PublicacionController::class,'borrado'])->name('publicaciones.borrado');
Route::get('/publicaciones/borradores/borrado',[PublicacionController::class,'borradoUsuario'])->name('publicaciones.borradoUsuario');
Route::post('/publicaciones/borrado/{id}/restaurar',[PublicacionController::class,'restaurarPublicacion'])->name('publicaciones.borrado.restaurar');
Route::post('/publicaciones/borrado/{id}/destroy',[PublicacionController::class,'eliminarPublicacionesBasura'])->name('publicaciones.borrado.destroy');

//Pagina de Auditoria//No funcionaba en otros lados
Route::get('/admin/auditoria', [AuditoriaController::class, 'index']) -> name('admin.auditoria');
Route::get('/admin/auditoriamas/{auditoria}', [AuditoriaController::class, 'show']) -> name('admin.auditoriamas');

//Pagina de Publicaciones
Route::get('/registroPropiedad',[PublicacionController::class, 'index'])->name('publicaciones.index');//Pagina principal para el registro de propiedad
Route::get('/registroPropiedad/create',[PublicacionController::class, 'create'])->name('publicaciones.create');//Crear Publicacion
Route::post('/registroPropiedad',[PublicacionController::class,'store'])->name('publicaciones.store');//Alcenar en la base de datos
Route::get('/registroPropiedad/{publicacion}',[PublicacionController::class, 'show'])->name('publicaciones.show');//Consultar Publicacion
Route::get('/registroPropiedad/{publicacion}/edit',[PublicacionController::class, 'edit'])->name('publicaciones.edit');//Modificar Publicacion
Route::get('/registroPropiedad/{publicacion}/pagar',[PublicacionController::class, 'pagar'])->name('publicaciones.pagar');//Pagar Publicacion
Route::patch('/registroPropiedad/{publicacion}',[PublicacionController::class, 'update'])->name('publicaciones.update');//Cambiar en BD Publicacion
Route::delete('/registroPropiedad/{publicacion}',[PublicacionController::class, 'destroy'])->name('publicaciones.destroy');//Eliminar Publicacion
//Pagina de Publicaciones admin
Route::get('/admin/publicaciones',[PublicacionController::class,'publicacionesAdmin'])->name('admin.publicacionesIndex');

//Pagina de Rating
Route::post('/registroPropiedad/{publicacion}',[RatingController::class, 'store'])->name('rating.store');//Almacenar en la base de datos
//Pagina rating admin
Route::get('/admin/rating',[RatingController::class, 'index'])->name('admin.rating');//Pagina principal para el registro de propiedad
Route::patch('/admin/rating/{rating}',[RatingController::class, 'update'])->name('admin.rating.update');//Eliminar Rating



//Pagina de Comentarios
//Route::get('/registroPropiedad/{publicacion}/comentarios',[ComentarioController::class, 'index'])->name('comentarios.index');//Comentarios de la Publicacion
//Route::post('/registroPropiedad/{publicacion}/comentarios',[ComentarioController::class, 'store'])->name('comentario.store');//Almacenar Comentario
////Route::get('/registroPropiedad/{publicacion}/comentarios/{comentario}/edit',[ComentarioController::class, 'editComentario'])->name('publicaciones.editComentario');//Modificar Comentario
//Route::patch('/registroPropiedad/{publicacion}/comentarios/{comentario}',[ComentarioController::class, 'update'])->name('comentario.update');//Cambiar en BD Comentario
//Route::delete('/registroPropiedad/{publicacion}/comentarios/{comentario}',[ComentarioController::class, 'destroy'])->name('comentario.destroy');//Eliminar Comentario


//Pagina de Contratos
Route::get('/contratos',[ContratoController::class, 'index'])->name('contratos.index');//Pagina principal para ver los contratos registrados
Route::get('/contratos/create',[ContratoController::class, 'create'])->name('contratos.create');//Crear Contrato
Route::post('/contratos',[ContratoController::class,'store'])->name('contratos.store');//Alcenar en la base de datos
Route::get('/contratos/{contrato}',[ContratoController::class, 'show'])->name('contratos.show');//Consultar Contrato
Route::get('/contratos/{contrato}/edit',[ContratoController::class, 'edit'])->name('contratos.edit');//Modificar Contrato
Route::patch('/contratos/{contrato}',[ContratoController::class, 'update'])->name('contratos.update');//Cambiar en BD Contrato
Route::delete('/contratos/{contrato}',[ContratoController::class, 'destroy'])->name('contratos.destroy');//Eliminar Contrato

//Pagina de Alquileres
Route::view('/alquileres','alquileres')->name('alquileres');

//Ruta para webhooks
Route::post('/webhooks', WebHooksController::class);


//Ruta about
Route::view('/about','about')->name('about');

Route::get('/', function () {
    return view('welcome');
});

//Ruta para creacion de PDF
Route::get('admin/users/pdf', [UserController::class, 'pdf'])->name('admin.users.pdf');
Route::get('/pdf', [AuditoriaController::class, 'pdf'])->name('auditoria.pdf');
Route::get('/pdfs', [AuditoriaController::class, 'pdfmas'])->name('auditoriamas.pdf'); //ver

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
