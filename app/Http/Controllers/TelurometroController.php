<?php

namespace App\Http\Controllers;


use App\Models\Firma;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Telurometro;

class TelurometroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Telurometro::all();
        return view("telurometro.index",compact("items"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $telurometros = Telurometro::all();
        return view("telurometro.create", compact("telurometros"));
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
            'tipo'=>'required',
            'marca'=>'required',
            'modelo'=>'required',
            'serie'=>'required',
        ));
        $input = $request->all();

        DB::beginTransaction();
            $telurometro = Telurometro::create(array(
            "nombre"=> $input["tipo"].'-'.$input["marca"].'-'.$input["modelo"].'-'.$input["serie"],
            "tipo" => $input["tipo"],
            "marca" => $input["marca"],
            "modelo" => $input["modelo"],
            "serie" => $input["serie"],
            "fechacalib" => $input["fechacalib"],
            "vigenciacalib" => $input["vigenciacalib"],

        ));

        DB::commit();

        return redirect("/telurometros")->with('grabado','ok');

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
        $telurometro=Telurometro::find($id);
        return view('telurometro.edit',  compact("telurometro"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate(array(
            'tipo'=>'required',
            'marca'=>'required',
            'modelo'=>'required',
            'serie'=>'required',

        ));

        $telurometro = telurometro::find($id);
        $telurometro->nombre = $request->get('tipo').'-'.$request["marca"].'-'.$request["modelo"].'-'.$request["serie"];
        $telurometro->tipo = $request->get('tipo');
        $telurometro->marca = $request->get('marca');
        $telurometro->modelo = $request->get('modelo');
        $telurometro->serie = $request->get('serie');
        $telurometro->fechacalib = $request->get('fechacalib');
        $telurometro->vigenciacalib = $request->get('vigenciacalib');
        $telurometro->save();

        return redirect("/telurometros");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $telurometro= Telurometro::find($id);
        $telurometro->delete();
        return redirect("/telurometros")->with("eliminar","ok");
    }
}
