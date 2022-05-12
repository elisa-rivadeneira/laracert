<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Image;
use App\Models\Certificado;
use App\Models\User;
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

Route::get('/', function () {
    return view('auth.login');
    // //     return view('welcome');
});//a


Route::resource('certificados', 'App\Http\Controllers\CertificadoController')->middleware('auth');
Route::resource('users', 'App\Http\Controllers\UserController')->middleware('auth');
Route::resource('firmas', 'App\Http\Controllers\FirmaController')->middleware('auth');
Route::get("/firma/delete/{id}", "App\Http\Controllers\FirmaController@destroy");
Route::get("/certificado/{id}/view", "App\Http\Controllers\CertificadoController@view");


Route::resource('telurometros', 'App\Http\Controllers\TelurometroController')->middleware('auth');

Route::post("/firma/{id}", "App\Http\Controllers\FirmaController@update");
Route::post("/telurometro/{id}", "App\Http\Controllers\TelurometroController@update");

Route::get("/certificado/firma/{id}", "App\Http\Controllers\FirmaController@show")->middleware('auth');;
//Route::get("/users/create", "App\Http\Controllers\UserController@create")->middleware('auth');;

Route::post("/certificado/guardar", "App\Http\Controllers\CertificadoController@save");
Route::get("/certificado/listar", "App\Http\Controllers\CertificadoController@index")->middleware('auth');;
Route::get("/certificado/crear", "App\Http\Controllers\CertificadoController@create");
Route::post("/certificado/{id}", "App\Http\Controllers\CertificadoController@update");
Route::get("/certificado/{id}/pdf", "App\Http\Controllers\CertificadoController@downloadPDF");

Route::get("/qrcode/{id}", "App\Http\Controllers\CertificadoController@qrgenerate");


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', "App\Http\Controllers\CertificadoController@index")->name('dashboard');

Route::get('/dashboard/crud', function(){
    return view('crud.index');
});

Route::get('/dashboard/crud/create', function(){
    return view('crud.create');
});

Route::get('/pdf', function () {
    //Imprime el documento PDF
    $pdf = PDF::loadHTML('Imprímeme bien todos los acentos en español. Aquí debe llevar tags. No los puse aquí, porque el blog me los interpreta provocando que este ejemplo se vea mal.');
    //El método "inline" sirve para mostrar el PDF justo en el navegador

    return $pdf->stream('prueba.pdf');
});

Route::get('/prueba', function(){

    $sql='SELECT COUNT(`imageable_id`)AS Imagenes, imageable_id AS Certificado FROM images GROUP BY imageable_id;';
    $nrocertif=DB::select($sql);
    return $nrocertif;


});

Route::get('/resultados', function(){
    $image=Image::find(18);
    return $image;
});

Route::get('/clear-cache', function() {
    Cache::flush();
    cache()->flush();
});

Route::get('/ubigeo', function(){
    return view('firma.ubigeopage');
});

Route::get('/ubigeo', 'App\Http\Controllers\UbigeoController@index')->name('ubigeo');
Route::get('/getProvincia/{id}', 'App\Http\Controllers\UbigeoController@getProvincia')->name('getProvincia');
Route::get('/getDistrito/{id}', 'App\Http\Controllers\UbigeoController@getDistrito')->name('getDistrito');
Route::get('/imagenprotocolo/{id}', 'App\Http\Controllers\ImageController@index')->name('imagenController');
