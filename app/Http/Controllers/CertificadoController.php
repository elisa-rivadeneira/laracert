<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use Illuminate\Http\Request;
use App\Models\Certificado;
use App\Models\Firma;
use App\Models\Telurometro;
use Illuminate\Support\Facades\DB;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Imagick;

class CertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    $certificados = Certificado::orderBy('id', 'desc')->get();
// dd($certificados);
  //     $certificados =  Certificado::orderBy('id', 'desc')->get();
        $certificados = Certificado::all();
        $firmas = Firma::all();
        return view("certificado.index",compact("firmas", "certificados"))->withHeaders('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $certificados = Certificado::all();
        $firmas= Firma::all();
        $telurometros = Telurometro::all(); //
        $departamentos = Departamento::all();
        $provincias = Provincia::all();
        $distritos = Distrito::all();


        return view("certificado.create", compact("firmas", "certificados", "telurometros","departamentos", "provincias", "distritos"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $request->validate(array(
                        'cliente'=>'required',
                        'departamento'=>'required',
                        'provincia'=>'required',
                        'distrito'=>'required',
                        'direccion' => 'required',
                        'firma' => 'required',
                        'telurometro' => 'required|not_in:0',
                        'pozoubicacion' => 'required',
                        'longitudelectrodo' => 'required',
                        'tipopozo' => 'required|not_in:0',
                        'conectadotablero' => 'required',
                        'taparegistro' => 'required|not_in:0',
                        'electrodomaterial' => 'required|not_in:0',
                        'electrododiametro' =>'required|not_in:0',
                        'cajatipo' => 'required|not_in:0',
                        'cajaestado' => 'required',
                        'cajaobservacion' => 'required',
                        'conectortipo' => 'required|not_in:0',
                        'conectorestado' => 'required',
                        'conectorobservacion' => 'required',
                        'cabletipo' => 'required|not_in:0',
                        'cableobservacion' => 'required',
                        'metodomedicion' => 'required',
                        'resistenciapozo' => 'required',
                        'qr' => 'required',
                        'nropozo' => 'required',
                        'vigenciamedicion' => 'required',
                        'fechamedicion'=>'required',
                        'imagenes.*'=>'image|mimes:jpeg,jpg,png,gif,svg|max:2048',
                        'distanciapicau' => 'required',
                        'distanciapicad' => 'required'


        ));



        $input = $request->all();


            DB::beginTransaction();
            $certificado = Certificado::create(array(
                "cliente" => $input["cliente"],
                "departamento" => $input["departamento"],
                "provincia" => $input["provincia"],
                "distrito" => $input["distrito"],
                "direccion" => $input["direccion"],
                "firma" => $input["firma"],
                "telurometro" => $input["telurometro"],
                "pozoubicacion" => $input["pozoubicacion"],
                "tipopozo" => $input["tipopozo"],
                "conectadotablero" => $input["conectadotablero"],
                "otraopcionconectadotablero" => $input["otraopcionconectadotablero"],
                "taparegistro" => $input["taparegistro"],
                "otraopciontaparegistro" => $input["otraopciontaparegistro"],
                "electrodomaterial" => $input["electrodomaterial"],
                "electrododiametro" => $input["electrododiametro"],
                "cajatipo" => $input["cajatipo"],
                "cajaestado" => $input["cajaestado"],
                "cajaobservacion" => $input["cajaobservacion"],
                "conectortipo" => $input["conectortipo"],
                "conectorestado" => $input["conectorestado"],
                "conectorobservacion" => $input["conectorobservacion"],
                "cabletipo" => $input["cabletipo"],
                "cablediametro" => $input["cablediametro"],
                "obsadicional" => $input["obsadicional"],
                "metodomedicion" => $input["metodomedicion"],
                "resistenciapozo" => $input["resistenciapozo"],
                "vihora" => $input["vihora"],
                "vifecha" => $input["vifecha"],
                "vimedicion" => $input["vimedicion"],
                "vfhora" => $input["vfhora"],
                "vffecha" => $input["vffecha"],
                "vfmedicion" => $input["vfmedicion"],
                "qr" => $input["qr"],
                "nropozo" => $input["nropozo"],
                "vigenciamedicion" => $input["vigenciamedicion"],
                "fechamedicion" => $input["fechamedicion"],
                "longitudelectrodo" => $input["longitudelectrodo"],
                "distanciapicau" => $input["distanciapicau"],
                "distanciapicad" => $input["distanciapicad"],



            ));



                $firmas=Firma::all();
                $telurometros=Telurometro::all();
                $firmacertif=$certificado->firma;
                $firma=Firma::find($firmacertif);
                $qrcodigo = base64_encode(QrCode::format('svg')->size(70)->errorCorrection('H')->generate('http://0.0.0.0/certificado/'.$certificado->id.'/pdf'));
                $telurometrocertif=$certificado->telurometro;
                $telurometro=Telurometro::find($telurometrocertif);





        DB::commit();


        $urlimages = [];

        if($request->hasFile('imagenes')){
            $imagenes = $request->file('imagenes');

            foreach($imagenes as $imagen){
                $nombre =$certificado->id.'_'.$imagen->getClientOriginalName();
                $ruta=public_path().'/imagenes';
                $urlimages[]['url']=$nombre;
                $imagen->move($ruta,$nombre);

            }

        }

        if($request->hasFile('fotocertif')){
            $imagen = $request->file('fotocertif');
            $nombre =$certificado->id.'-fotocertif.jpg';
            $ruta=public_path().'/imagenes/certificados';
            $rutacompleta=$ruta.'/'.$nombre;
            $imagen->move($ruta,$nombre);
            $imageng=new Image(['url'=>$rutacompleta]);
            $certificado->image()->save($imageng);

        }else{
            $rutacompleta='imagenes/certificados/blank.png';
            $imageng=new Image(['url'=>$rutacompleta]);
            $firma->image()->save($imageng);
        }

        $sqlfirmas=Image::where('imageable_id','=',$firmacertif)->where('imageable_type','=','App\Models\Firma')->get();

        $ubigeo = DB::table('distritos')->where('nombre',  $certificado->distrito)->value('ubigeo');
        $certificado->images()->createMany($urlimages);

        $pdf =PDF::loadView('certificado.pdf', compact("firma", "certificado", "telurometro", "telurometros", "firmas","qrcodigo","ubigeo", "sqlfirmas"))->save('protocolos/protocolo-000'.$certificado->nombre.$certificado->id.'.pdf');


   //         return redirect("/certificados/".$certificado->id."/edit")->with('status', '1')->with('grabado','ok');;
         return redirect("/certificados");

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $certificado=Certificado::find($id);
        $firmas=Firma::all();
        $departamentos=Departamento::all();
        $provincias=Provincia::all();
        $distritos=Distrito::all();
        $telurometros=Telurometro::all();
        $firmacertif=$certificado->firma;
        $firma=Firma::find($firmacertif);
        $telurometrocertif=$certificado->telurometro;
        $telurometro=Telurometro::find($telurometrocertif);


     //   return dd($certificado->images);

        return view('certificado.edit',  compact("firma", "certificado", "telurometro", "telurometros", "firmas", "departamentos", "provincias", "distritos"));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(array(
            'cliente'=>'required',
            'departamento'=>'required',
            'provincia'=>'required',
            'distrito'=>'required',
            'direccion' => 'required',
            'firma' => 'required',
            'telurometro' => 'required|not_in:0',
            'pozoubicacion' => 'required',
            'longitudelectrodo' => 'required',
            'tipopozo' => 'required|not_in:0',
            'conectadotablero' => 'required',
            'taparegistro' => 'required|not_in:0',
            'electrodomaterial' => 'required|not_in:0',
            'electrododiametro' =>'required|not_in:0',
            'cajatipo' => 'required|not_in:0',
            'cajaestado' => 'required',
            'cajaobservacion' => 'required',
            'conectortipo' => 'required|not_in:0',
            'conectorestado' => 'required',
            'conectorobservacion' => 'required',
            'cabletipo' => 'required|not_in:0',
            'metodomedicion' => 'required',
            'resistenciapozo' => 'required',
            'qr' => 'required',
            'nropozo' => 'required',
            'vigenciamedicion' => 'required',
            'fechamedicion' => 'required',
            'distanciapicau' => 'required',
            'distanciapicad' => 'required'



        ));



        $certificado = Certificado::find($id);

        $certificado->cliente = $request->get('cliente');
        $certificado->departamento = $request->get('departamento');
        $certificado->provincia = $request->get('provincia');
        $certificado->distrito = $request->get('distrito');
        $certificado->agencia = $request->get('agencia');
        $certificado->direccion= $request->get('direccion');
        $certificado->firma= $request->get('firma');
        $certificado->telurometro = $request->get('telurometro');
        $certificado->qr = $request->get('qr');
        $certificado->pozoubicacion = $request->get('pozoubicacion');
        $certificado->tipopozo = $request->get('tipopozo');
        $certificado->conectadotablero = $request->get('conectadotablero');
        $certificado->otraopcionconectadotablero = $request->get('otraopcionconectadotablero');
        $certificado->taparegistro = $request->get('taparegistro');
        $certificado->otraopciontaparegistro = $request->get('otraopciontaparegistro');
        $certificado->electrodomaterial = $request->get('electrodomaterial');
        $certificado->electrodomaterial = $request->get('electrodomaterial');
        $certificado->cajatipo = $request->get('cajatipo');
        $certificado->cajaestado = $request->get('cajaestado');
        $certificado->cajaobservacion = $request->get('cajaobservacion');
        $certificado->conectortipo = $request->get('conectortipo');
        $certificado->conectorestado = $request->get('conectorestado');
        $certificado->conectorobservacion = $request->get('conectorobservacion');
        $certificado->cabletipo = $request->get('cabletipo');
        $certificado->cablediametro = $request->get('cablediametro');
        $certificado->obsadicional = $request->get('obsadicional');
        $certificado->metodomedicion = $request->get('metodomedicion');
        $certificado->resistenciapozo = $request->get('resistenciapozo');
        $certificado->vihora = $request->get('vihora');
        $certificado->vifecha = $request->get('vifecha');
        $certificado->vimedicion = $request->get('vimedicion');
        $certificado->vfhora = $request->get('vfhora');
        $certificado->vffecha = $request->get('vffecha');
        $certificado->vfmedicion = $request->get('vfmedicion');
        $certificado->nropozo = $request->get('nropozo');
        $certificado->vigenciamedicion= $request->get('vigenciamedicion');
        $certificado->fechamedicion= $request->get('fechamedicion');
        $certificado->distanciapicau= $request->get('distanciapicau');
        $certificado->distanciapicad= $request->get('distanciapicad');
        $certificado->save();


        if($request->hasFile('fotocertif')){

            Image::where('imageable_type', 'App\Models\Certificado')->where('imageable_id', $certificado->id)->delete();

            $imagen = $request->file('fotocertif');
            $nombre = $certificado->id.'-fotocertif.jpg';
            $ruta = public_path().'/imagenes/certificados';
            $imagen->move($ruta,$nombre);
            $rutacompleta=$ruta.'/'.$nombre;
            $imageng=new Image(['url'=>$rutacompleta]);
            $certificado->image()->save($imageng);
        }




        $firmas=Firma::all();
        $telurometros=Telurometro::all();
        $firmacertif=$certificado->firma;
        $firma=Firma::find($firmacertif);
        $qrcodigo = base64_encode(QrCode::format('svg')->size(70)->errorCorrection('H')->generate('http://0.0.0.0/certificado/'.$certificado->id.'/pdf'));
        $telurometrocertif=$certificado->telurometro;
        $telurometro=Telurometro::find($telurometrocertif);
        $sqlfirmas=Image::where('imageable_id','=',$firmacertif)->where('imageable_type','=','App\Models\Firma')->get();

        $ubigeo = DB::table('distritos')->where('nombre',  $certificado->distrito)->value('ubigeo');







        $pdf =PDF::loadView('certificado.pdf', compact("firma", "certificado", "telurometro", "telurometros", "firmas","qrcodigo","ubigeo", "sqlfirmas"))->save('protocolos/protocolo-000'.$certificado->nombre.$certificado->id.'.pdf');
          return redirect('/certificados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $certificado= Certificado::find($id);
        $certificado->delete();
        return redirect('/certificados')->with('eliminar','ok');
    }
    public function downloadPDF($id)
    {
        $certificado=Certificado::find($id);
        $firmas=Firma::all();
        $telurometros=Telurometro::all();
        $firmacertif=$certificado->firma;

        $foldercertificado=env('APP_URL');

        $firma=Firma::find($firmacertif);
     //  $qrcodigo = base64_encode(QrCode::format('svg')->size(70)->errorCorrection('H')->generate('http://0.0.0.0/certificado/'.$certificado->id.'/pdf'));
            $qrcodigo = base64_encode(QrCode::format('svg')->size(70)->errorCorrection('H')->generate($foldercertificado.'/certificado/'.$certificado->id.'/view'));




        $ubigeo = DB::table('distritos')->where('nombre',  $certificado->distrito)->value('ubigeo');

        $telurometrocertif=$certificado->telurometro;
        $telurometro=Telurometro::find($telurometrocertif);

      $sqlfirmas=Image::where('imageable_id','=',$firmacertif)->where('imageable_type','=','App\Models\Firma')->get();
  //      $sqlfirma = DB::table('firmas')->where('id','=',$firmacertif)->get();
      // $image=Image::find( $sqlfirma->imageable_id);



        $pdf =PDF::loadView('certificado.pdf', compact("firma", "certificado", "telurometro", "telurometros", "firmas","qrcodigo", "ubigeo", "sqlfirmas"));


        //     return view('certificado.pdf',compact("firma", "certificado", "telurometro", "telurometros", "firmas"));
        //     $pdf->loadHTML('<h1>Test</h1>');
       return $pdf->stream();
        //    return $pdf->download('mi-archivo.pdf');




    }


    public function qrgenerate($id)
    {
     return QrCode::generate('http://pozoatierra.ciberaulas.com/certificado/'.$id.'/pdf', $id.'.svg');
        return redirect('/certificados')->with('eliminar','ok');
    }

    public function view($id){
        $certificado=Certificado::find($id);

        $imgExt = new \Imagick();

        $imgExt->readImage(public_path('protocolos/protocolo-000'.$certificado->nombre.$certificado->id.'.pdf'));

        $imgExt->setResolution(600, 600);

        $imgExt->setBackgroundColor('white');

        $imgExt->setImageFormat('jpg');

        $imgExt->scaleImage(1500, 1500, true);

        $imgExt->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);

        $imgExt->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
        $imgExt->writeImages('protocolos/protocolo-000'.$certificado->id.'.jpg', true);

        return view('certificado.view.index', compact("certificado"));

    }

}
