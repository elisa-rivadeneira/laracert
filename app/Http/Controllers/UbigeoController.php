<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provincia;
use App\Models\Departamento;
use App\Models\Distrito;

class UbigeoController extends Controller
{
    public function index(){
        $departamentos = Departamento::all();
        $provincias = Provincia::all();
        $distritos = Distrito::all();
        return view('firma.ubigeopage', compact('departamentos','provincias','distritos'));
    }

    public function getProvincia($id){
        $provincias=Provincia::where('departamento_id',$id)->pluck("nombre","id");
        return json_encode($provincias);
    }

    public function getDistrito($id){
        $distritos=Distrito::where('provincia_id',$id)->pluck("nombre","id","ubigeo");
        return json_encode($distritos);
    }


}
