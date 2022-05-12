<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\Certificado;
use App\Models\Firma;
use App\Models\Telurometro;
use Illuminate\Support\Facades\DB;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;


class FirmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql='SELECT firmas.id,firmas.nombre, firmas.fotopic, firmas.cip, firmas.colegiaturafile, (SELECT COUNT(*) FROM certificados WHERE firmas.id = certificados.firma) AS CertificadosEmitidos FROM firmas;';
        $items=DB::select($sql);
        $images=Image::all();



        return view("admin.inadmin",compact("items","images"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $firmas = Firma::all();
        return view("firma.create", compact("firmas"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(array(
            'nombre'=>'required',
            'cip' => 'required',
            'especialidad' => 'required',

        ));
        $input = $request->all();
        $rutacompleta='';

        if($request->hasFile('colegiaturafile')){
            $colegiatura = $request->file('colegiaturafile');
            $nombre = $request->cip.'-colegiatura';
            $extension = $request->file('colegiaturafile')->getClientOriginalExtension();
            $nombrecompleto =$nombre.'.'.$extension;
            $ruta = 'imagenes/firmas';
            $rutacompleta=$ruta.'/'.$nombrecompleto;
            $colegiatura->move($ruta,$nombrecompleto);
        }

        DB::beginTransaction();
        $firma = Firma::create(array(
            "nombre" => $input["nombre"],
            "cip" => $input["cip"],
            "especialidad" => $input["especialidad"],
            "colegiaturafile" => $rutacompleta,
        ));


        DB::commit();

        if($request->hasFile('fotopic')){
                $imagen = $request->file('fotopic');
                $nombre =$firma->id.'-foto.jpg';
                $ruta=public_path().'/imagenes/firmas';
                $rutacompleta=$ruta.'/'.$nombre;
                $imagen->move($ruta,$nombre);
        }

        if($request->hasFile('firmapic')){
            $imagen = $request->file('firmapic');
            $nombre =$firma->id.'-firma.jpg';
            $ruta=public_path().'/imagenes/firmas';
            $rutacompleta=$ruta.'/'.$nombre;
            $imagen->move($ruta,$nombre);
            $imageng=new Image(['url'=>$rutacompleta]);
            $firma->image()->save($imageng);
        }else{
            $rutacompleta='imagenes/firmas/blank.png';
            $imageng=new Image(['url'=>$rutacompleta]);
            $firma->image()->save($imageng);
        }




        return redirect("/firmas")->with('grabado','ok');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $certificados=Certificado::where('firma','=',$id)->get();
        $firma=Firma::find($id);
        return view("admin.certificadosxfirma",compact("certificados","firma"));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $firma=Firma::find($id);

        return view('firma.edit',  compact("firma"));

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
            'nombre'=>'required',
            'cip' => 'required',
            'especialidad' => 'required',
        ));

        if($request->hasFile('colegiaturafile')){
            $colegiatura = $request->file('colegiaturafile');
            $nombre = $request->cip.'-colegiatura';
            $extension = $request->file('colegiaturafile')->getClientOriginalExtension();
            $nombrecompleto =$nombre.'.'.$extension;
            $ruta = 'imagenes/firmas';
            $rutacompleta = $ruta.'/'.$nombrecompleto;
            $colegiatura->move($ruta,$nombrecompleto);
        }else{
            $firma=Firma::find($id);
            $rutacompleta = $firma->colegiaturafile;
        }

        $firma = firma::find($id);

        $firma->nombre = $request->get('nombre');
        $firma->cip = $request->get('cip');
        $firma->especialidad= $request->get('especialidad');
        $firma->colegiaturafile= $rutacompleta;
        $firma->save();

        if($request->hasFile('fotopic')){
            $imagen = $request->file('fotopic');
            $nombre =$firma->id.'-foto.jpg';
            $ruta=public_path().'/imagenes/firmas';
            $rutacompleta=$ruta.'/'.$nombre;
            $imagen->move($ruta,$nombre);
            $imageng=new Image(['url'=>$rutacompleta]);
            $firma->image()->save($imageng);

        }

        if($request->hasFile('firmapic')){
            Image::where('imageable_type', 'App\Models\Firma')->where('imageable_id', $firma->id)->delete();
            $imagen = $request->file('firmapic');
            $nombre =$firma->id.'-firma.jpg';
            $ruta=public_path().'/imagenes/firmas';
            $imagen->move($ruta,$nombre);
            $rutacompleta=$ruta.'/'.$nombre;
            $imageng=new Image(['url'=>$rutacompleta]);
            $firma->image()->save($imageng);
        }


        return redirect("/firmas");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $firma= Firma::find($id);
        $firma->delete();
        return redirect("/firmas")->with("eliminar","ok");
    }
    public function downloadPDF($id)
    {
        $certificado=Certificado::find($id);
        $firmas=Firma::all();
        $telurometros=Telurometro::all();
        $firmacertif=$certificado->firma;
        $firma=Firma::find($firmacertif);
        $qrcodigo = base64_encode(QrCode::format("svg")->size(70)->errorCorrection("H")->generate("http://0.0.0.0/certificado/".$certificado->id."/pdf"));

        $sqlfirma=Image::where("imageable_id","=",$firmacertif)->get();
        $image=Image::find( $sqlfirma);


        $telurometrocertif=$certificado->telurometro;
        $telurometro=Telurometro::find($telurometrocertif);


        $pdf =PDF::loadView("certificado.pdf", compact("firma", "certificado", "telurometro", "telurometros", "firmas","qrcodigo", "image"));




        //        return view("certificado.pdf",compact("firma", "certificado", "telurometro", "telurometros", "firmas"));
        //     $pdf->loadHTML("<h1>Test</h1>");
        return $pdf->stream();
        //    return $pdf->download("mi-archivo.pdf");
    }


    public function qrgenerate($id)
    {
        return QrCode::generate("http://0.0.0.0/certificado/".$id."/pdf", $id.".svg");

    }

}

