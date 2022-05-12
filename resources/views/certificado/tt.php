@extends('adminlte::page')
@section('title', 'Certificado')
@section('css')
<!-- Ekko Lightbox -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2-selection {
        height: calc(2.25rem + 2px) !important;
    }

    body{
        padding: 5px 5px -0px 5px;
        font: 13px Arial, Helvetica, sans-serif;
        font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";

        /*    text-transform: uppercase; */

    }



    .valida{
        margin-top:-14px ;
        color: red;
        font-size: 11px;
    }

    h1{
        font:18px Arial, Helvetica, sans-serif !important;
        margin: auto;
    }
    @media screen and (max-width: 768px) {
        h1{
            font-size:16px;
            font-weight: bold;
        }

        .p-3 {
            padding: $spacer * .05 !important;
        }
    }

</style>
@stop



@section('content_header')
<div class="m-0 row justify-content-center text-dark p-1"><h1>EDITAR CERTIFICADO</h1></div>
@stop

@section("content")

<form action="/certificado/{{$certificado->id}}" method="post">
    @csrf
    <div class="m-0 row justify-content-center">
        <div class="col-md-10">
            <div class="card m-3 row justify-content-center text-primary p-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="text-center">DATOS DEL SOLICITANTE</h4>
                </div>
                <div class="row card-body text-secondary ">
                    <div class="form-group col-xs-12 col-md-12">
                        <label for="">CLIENTE</label>
                        <input placeholder="INGRESE NOMBRE DEL CLIENTE" type="text" class="form-control" name="cliente" value="{{old('cliente',$certificado->cliente)}}">
                        @error('cliente')
                        <br>
                        <div class="valida">*{{ $message }}</div>
                        <br>
                        @enderror
                    </div>
                    <div class="input-group row col-xs-12 col-md-12">
                        <div class="col-md-2 ">
                            <label for="" >TIENE AGENCIA</label>
                        </div>
                        <div class="col-md-10 ">
                            <div class="form-check form-check-inline input-group-addon">
                                <input  name="tieneagencia" type="radio" id="sitieneagencia" value="si" style="vertical-align:middle; cursor: pointer;" class="form-check-input" >
                                <label for="si">SI</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input  name="tieneagencia" type="radio" id="notieneagencia" value="no"  style="vertical-align:middle; cursor: pointer;" class="form-check-input" checked>
                                <label for="no">NO</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-10" id="agencia" style="display:none">
                        <label for="">INDICAR AGENCIA</label>
                        <input type="text" class="form-control" name="agencia" value="{{old('agencia', $certificado->agencia)}}">
                        @error('agencia')
                        <br>
                        <div class="valida">*{{ $message }}</div>
                        <br>
                        @enderror
                    </div>
                    <!-- START UBIGEO --!>
                    <div class="form-group col-xs-12 col-md-12" id="ubigeosection" >
                        <div class="panel panel-primary">
                            <label for=""><BR>INDICAR LOCALIZACIÓN</label>
                            <div class="row panel-body">
                                <div class="col-md-4">
                                    <select class="form-control form-select" name="departamento" id="departamento">
                                        <option selected="false">Departamento</option>
                                        @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->nombre}}" {{ $departamento->nombre == $certificado->departamento ? 'selected' : '' }}>{{$departamento->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control form-select" name="provincia" id="provincia">
                                        <option selected="false">Provincias</option>
                                        @foreach($provincias as $provincia)
                                        <option value="{{$provincia->nombre}}" {{ $provincia->nombre == $certificado->provincia ? 'selected' : '' }}>{{$provincia->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-control form-select" name="distrito" id="distrito" onchange="colocar_ubigeo()">
                                        <option selected="false">Distritos...</option>
                                        @foreach($distritos as $distrito)
                                        <option value="{{$distrito->nombre}}" {{ $distrito->nombre == $certificado->distrito ? 'selected' : '' }}>{{$distrito->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END UBIGEO --!>
                    <div class="form-group col-xs-12 col-md-12">
                        <label for="">DIRECCIÓN</label>
                        <input type="text" class="form-control" name="direccion" value="{{old('direccion', $certificado->direccion)}}" placeholder="DIRECCIÓN">
                        @error('direccion')
                        <br>
                        <div class="valida">*{{ $message }}</div>
                        <br>
                        @enderror
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card m-3 row justify-content-center text-primary p-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="text-center">DATOS DEL COLEGIADO</h4>
                </div>
                <div class="row card-body text-secondary ">
                    <div class="form-group col-xs-12 col-md-4">
                        <label for="">PROFESIONAL RESPONSABLE</label>
                        <select id="firma" name="firma" class="form-control" onchange="colocar_cip()" value="{{ old('firma') }}">
                            <option value="">Seleccione</option>
                            @foreach($firmas as $value)
                            <option cip="{{ $value->cip }}" value="{{ $value->id }}" {{ $value->id == $firma->id ? 'selected' : '' }}  ">{{ $value->nombre }}</option>                            @endforeach
                        </select>
                        <div>
                            @error('firma')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-4">
                        <label for="">CIP</label>
                        <input id="cip" type="text" class="form-control" name="cip" value="{{old('cip', $firma->cip)}}" readonly>
                    </div>
                    <div class="form-group col-xs-12 col-md-4">
                        <label for="">ESPECIALIDAD</label>
                        <input id="especialidad" type="text" class="form-control" name="especialidad" value="{{old('especialidad', $firma->especialidad)}}" readonly>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-10">
            <div class="card m-3 row justify-content-center text-primary p-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="text-center"> CARACTERÍSTICAS TÉCNICAS DEL SPAT</h4>
                </div>
                <div class="row card-body text-secondary">
                    <div class="col-3 input-group input-group-lg" style="margin-bottom: 15px;"></div>
                    <div class="form-group col-xs-12 col-md-12 col-lg-12">
                        <label for="" style="margin-right: 10px;">POZO A TIERRA NRO: </label>
                        <input type="number" class="form-control" name="nropozo" width="40px" value="{{old('nropozo',$certificado->nropozo)}}" >
                        @error('nropozo')
                        <br>
                        <div class="valida">*{{ $message }}</div>
                        <br>
                        @enderror
                    </div>
                    <div class="form-group col-xs-12 col-md-12 ">
                        <label for="">UBICACIÓN</label>
                        <input placeholder="UBICACIÓN" type="text" class="form-control" name="pozoubicacion" value="{{old('pozoubicacion',$certificado->pozoubicacion)}}">
                        @error('pozoubicacion')
                        <br>
                        <div class="valida">*{{ $message }}</div>
                        <br>
                        @enderror
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="">CONECTADO AL TABLERO DE</label>
                        <select id="conectadotablero" name="conectadotablero" class="form-control" value="{{old('conectadotablero',$certificado->conectadotablero)}}" >
                            <option value="">CONECTADO AL TABLERO DE</option>
                            <option value="GENERAL" {{ old('conectadotablero',$certificado->conectadotablero) == "GENERAL" ? "selected" : "" }}>GENERAL</option>
                            <option value="DISTRIBUCION" {{ old('conectadotablero',$certificado->conectadotablero) == "DISTRIBUCION" ? "selected" : "" }}>DISTRIBUCIÓN</option>
                            <option value="PRINCIPAL" {{ old('conectadotablero',$certificado->conectadotablero) == "PRINCIPAL" ? "selected" : "" }}>PRINCIPAL</option>
                            <option value="ILUMINACION" {{ old('conectadotablero',$certificado->conectadotablero) == "ILUMINACION" ? "selected" : "" }}>ILUMINACIÓN</option>
                            <option value="OTRO" {{ old('conectadotablero',$certificado->conectadotablero) == "OTRO" ? "selected" : "" }} id="conectadotablerootro">OTRO</option>
                        </select>
                        <input type="text" name="otraopcionconectadotablero" id="otraopcionconectadotablero"  placeholder="Indicar la conección del tablero" class="form-control" style="display:none" value=" " aria-label="Alto">
                        <div>
                            @error('conectadotablero')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-xs-0 col-md-1 ">
                    </div>
                    <div class="form-group col-xs-12 col-md-5 ">
                        <label for="">TIPO DE POZO</label>
                        <select id="tipopozo" name="tipopozo" class="form-control" value="{{old('tipopozo',$certificado->tipopozo)}}" >
                            <option value="">TIPO DE POZO</option>
                            <option value="VERTICAL"  {{ old('tipopozo',$certificado->tipopozo) == "VERTICAL" ? "selected" : "" }}>VERTICAL</option>
                            <option value="HORIZONTAL" {{ old('tipopozo',$certificado->tipopozo) == "HORIZONTAL" ? "selected" : "" }}>HORIZONTAL</option>
                        </select>
                        <div>
                            @error('tipopozo')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-md-6">
                        <label for="">TAPA REGISTRO</label>
                        <select id="taparegistro" name="taparegistro" class="form-control" value="{{old('taparegistro',$certificado->taparegistro)}}">
                            <option value="" >TAPA REGISTRO</option>
                            <option value="PVC" {{ old('taparegistro',$certificado->taparegistro) == "PVC" ? "selected" : "" }} >PVC</option>
                            <option value="BRONCE" {{ old('taparegistro',$certificado->taparegistro) == "BRONCE" ? "selected" : "" }} >BRONCE</option>
                            <option value="CONCRETO" {{ old('taparegistro',$certificado->taparegistro) == "CONCRETO" ? "selected" : "" }} >CONCRETO</option>
                            <option value="OTRO" {{ old('taparegistro',$certificado->taparegistro) == "OTRO" ? "selected" : "" }} id="taparegistrootro" >OTRO</option>
                        </select>
                        <div>
                            @error('taparegistro')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                        <input type="text" name="otraopciontaparegistro" id="otraopciontaparegistro"  value=" " style="display:none" class="form-control" aria-label="Alto" placeholder="Indicar el material de la tapa de registro ">
                    </div>
                    <div class="form-group col-xs-0 col-md-1 ">
                    </div>
                    <div class="form-group col-xs-12 col-md-4">
                        <label for="">LONGITUD DE ELECTRODO</label>
                        <input type="text" name="longitudelectrodo" id="longitudelectrodo"  placeholder="LONGITUD DE ELECTRODO" class="form-control" value="{{old('longitudelectrodo',$certificado->longitudelectrodo)}}" aria-label="Alto">
                        <div>
                            @error('longitudelectrodo')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-xs-0 col-md-1 ">
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for="">MATERIAL DE ELECTRODO</label>
                        <select id="electrodomaterial" name="electrodomaterial" class="form-control" value="{{ old('electrodomaterial',$certificado->electrodomaterial) }}">
                            <option value="">MATERIAL DE ELECTRODO</option>
                            <option value="Cobre (Cu) " {{ old('electrodomaterial',$certificado->electrodomaterial) == "Cobre (Cu)" ? "selected" : "" }}>Cobre (Cu)"</option>
                            <option value="Copperweld" {{ old('electrodomaterial',$certificado->electrodomaterial) == "Copperweld" ? "selected" : "" }}>Copperweld"</option>
                        </select>
                        <div>
                            @error('electrodomaterial')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-xs-0 col-md-1 ">
                    </div>
                    <div class="form-group col-xs-12 col-md-5">
                        <label for="">DIAMETRO DE ELECTRODO</label>
                        <select name="electrododiametro" class="form-control" value="{{ old('electrododiametro',$certificado->electrododiametro)}}">
                            <option value="{{ old('electrododiametro',$certificado->electrododiametro) }}">DIAMETRO DE ELECTRODO</option>
                            <option value="VARILLA DE 1/2" {{ old('electrododiametro',$certificado->electrododiametro) == "VARILLA DE 1/2" ? "selected" : "" }}>VARILLA DE 1/2"</option>
                            <option value="VARILLA DE 3/4" {{ old('electrododiametro',$certificado->electrododiametro) == "VARILLA DE 3/4" ? "selected" : "" }}>VARILLA DE 3/4"</option>
                            <option value="VARILLA DE 5/8" {{ old('electrododiametro',$certificado->electrododiametro) == "VARILLA DE 5/8" ? "selected" : "" }}>VARILLA DE 5/8"</option>
                        </select>
                        <div>
                            @error('electrododiametro')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-6">
                        <label for=""> CABLE CONDUCTOR DE PUESTA A TIERRA</label>
                        <select  name="cabletipo" class="form-control" value="{{ old('cabletipo',$certificado->cabletipo) }}">
                            <option value="{{ old('cabletipo') }}">CABLE CONDUCTOR DE PUESTA A TIERRA</option>
                            <option value="desnudo" {{ old('cabletipo',$certificado->cabletipo) == "desnudo" ? "selected" : "" }} >Cu Desnudo</option>
                            <option value="aislado" {{ old('cabletipo',$certificado->cabletipo) == "aislado" ? "selected" : "" }} >Cu Aislado</option>
                        </select>
                        <div>
                            @error('cabletipo')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-xs-0 col-md-1 ">
                    </div>
                    <div class="form-group col-xs-12 col-md-5">
                        <label for=""> DIAMETRO DEL CABLE CONDUCTOR</label>
                        <select  name="cablediametro" class="form-control" value="{{ old('cablediametro',$certificado->cablediametro) }}">
                            <option value="{{ old('cablediametro') }}">DIAMETRO DEL CABLE CONDUCTOR</option>
                            <option value="25 mm2" {{ old('cablediametro',$certificado->cablediametro) == "25 mm2" ? "selected" : "" }} >25 mm2</option>
                            <option value="35 mm2" {{ old('cablediametro',$certificado->cablediametro) == "35 mm2" ? "selected" : "" }} >35 mm2</option>
                            <option value="50 mm2" {{ old('cablediametro',$certificado->cablediametro) == "50 mm2" ? "selected" : "" }} >50 mm2</option>
                            <option value="70 mm2" {{ old('cablediametro',$certificado->cablediametro) == "70 mm2" ? "selected" : "" }} >70 mm2</option>
                        </select>
                        <div>
                            @error('cablediametro')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                    <div class="form-group col-xs-12 col-md-6">
                        <label>CAJA DE REGISTRO</label>
                        <select name="cajatipo" class="form-control" value="{{ old('cajatipo',$certificado->cajatipo) }}" >
                            <option value="">CAJA DE REGISTRO</option>
                            <option value="MATERIAL DE CONCRETO" {{ old('cajatipo',$certificado->cajatipo) == "MATERIAL DE CONCRETO" ? "selected" : "" }}>MATERIAL DE CONCRETO</option>
                            <option value="MATERIAL PVC" {{ old('cajatipo',$certificado->cajatipo) == "MATERIAL PVC" ? "selected" : "" }}>MATERIAL PVC</option>
                            <option value="OTRO" {{ old('cajatipo',$certificado->cajatipo) == "OTRO" ? "selected" : "" }} >OTRO</option>
                        </select>
                        <div>
                            @error('cajatipo')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-xs-0 col-md-1 ">
                    </div>
                    <div class="input-group col-xs-12 col-md-5">
                        <label >ESTADO: </label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input  name="cajaestado" type="radio" id="cajaok" value="ok" style="vertical-align:middle; cursor: pointer;" class="form-check-input" checked>
                                <label for="ok">OK</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input  name="cajaestado" type="radio" id="cajaobs" value="obs"  style="vertical-align:middle; cursor: pointer;" class="form-check-input" >
                                <label for="obs">OBSERVACIONES</label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group col-xs-12 col-md-12" id="observacionescaja" style="display:none">
                        <div class="form-group ">
                            <label for=""> OBSERVACIONES </label>
                            <input type="text" class="form-control" name="cajaobservacion" value="-">
                        </div>
                    </div>
                    <div class="form-group col-xs-12 col-md-6 mt-4" >
                        <label for="">CONECTOR AB</label>
                        <select name="conectortipo" class="form-control" value="c">
                            <option value="{{ old('conectortipo',$certificado->conectortipo)}}">CONECTOR AB</option>
                            <option value="1/2“" {{ old('conectortipo',$certificado->conectortipo) == "1/2“" ? "selected" : "" }}>1/2 “</option>
                            <option value="3/4“" {{ old('conectortipo',$certificado->conectortipo) == "3/4“" ? "selected" : "" }}>3/4“</option>
                            <option value="5/8“" {{ old('conectortipo',$certificado->conectortipo) == "5/8“" ? "selected" : "" }} > 5/8“ </option>
                        </select>
                        <div>
                            @error('conectortipo')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-xs-0 col-md-1 ">
                    </div>
                    <div class="input-group col-xs-12 col-md-5 " style = "padding:auto; margin: auto;">
                        <label >ESTADO : </label>
                        <div class="col-sm-10">
                            <div class="form-check form-check-inline">
                                <input  name="conectorestado" type="radio" id="conectorok" value="ok" style="vertical-align:middle; cursor: pointer;" class="form-check-input" checked>
                                <label for="OK">OK</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input  name="conectorestado" type="radio" id="conectorobs" value="obs"  style="vertical-align:middle; cursor: pointer;" class="form-check-input" >
                                <label for="obs">OBSERVACIONES</label>
                            </div>
                        </div>

                    </div>
                    <div class="form-group col-12" id="observacionesconector" style="display:none">
                        <div class="form-group ">
                            <label for=""> OBSERVACIONES </label>
                            <input type="text" class="form-control" name="conectorobservacion" value="{{ old('conectorobservacion',$certificado->conectorobservacion)}}">
                        </div>
                    </div>

                    <div class="form-group col-12 mt-5">
                        <label for="">OBSERVACIONES ADICIONALES</label>
                        <textarea type="text" class="form-control" name="obsadicional" value="{{ old('obsadicional',$certificado->obsadicional)}}" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card m-3 row justify-content-center text-primary p-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="text-center">LECTURA DE MEDICIÓN SPAT</h4>
                </div>
                <div class="card-body text-secondary ">
                    <div class="row">
                        <div class="form-group col-xs-6 col-md-6">
                            <label for="">METODO DE MEDICION</label>
                            <input id="metodomedicion" type="text" class="form-control"  name="metodomedicion" placeholder="METODO WERNNER" value="METODO WERNNER" readonly >
                        </div>
                        <div class="form-group col-xs-6 col-md-6">
                            <label for="">TELURÓMETRO</label>
                            <select name="telurometro" class="form-control" value="{{ old('telurometro',$certificado->telurometro)}}">
                                <option value="{{ old('telurometro',$certificado->telurometro)}}">Seleccione</option>
                                @foreach($telurometros as $value)
                                <option value="{{ $value->id }}" {{ old('telurometro', $telurometro->id) == $value->id ? "selected" : "" }}>{{ $value->nombre }}</option>                                @endforeach
                            </select>
                            <div>
                                @error('telurometro')
                                <br>
                                <div class="valida">*{{ $message }}</div>
                                <br>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row col-xs-12 col-md-12" style="margin-top:20px; margin-bottom: 20px;">
                        <H5>DISTANCIA ENTRE PICAS AUXILIARES </H5>
                    </div>
                    <div class="row">
                        <div class="form-group  col-xs-12 col-md-6 ">
                            <label for="">DISTANCIA DE PICA DE CORRIENTE (A) </label>
                            <div class="input-group ">
                                <input type="text" id="distanciapicau" name="distanciapicau" class="form-control" value="{{ old('distanciapicau',$certificado->distanciapicau)}}"  placeholder="DISTANCIA DE PICA DE CORRIENTE (A)">
                                <span class="input-group-text">mt</span>
                            </div>
                        </div>
                        @error('distanciapicau')
                        <br>
                        <div class="valida">*{{ $message }}</div>
                        <br>
                        @enderror
                        <div class="form-group col-xs-12 col-md-6 ">
                            <label for="">DISTANCIA DE PICA DE DIFERENCIA DE POTENCIA (V)</label>
                            <div class="input-group ">
                                <input type="text" id="distanciapicad" name="distanciapicad" class="form-control" value="{{ old('distanciapicad',$certificado->distanciapicad)}}" placeholder="DISTANCIA DE PICA DE DIFERENCIA DE POTENCIA (V)">
                                <span class="input-group-text">mt</span>
                            </div>
                        </div>
                        @error('distanciapicad')
                        <br>
                        <div class="valida">*{{ $message }}</div>
                        <br>
                        @enderror
                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">RESISTENCIA DE POZO</label>
                            <div class="input-group mb-3">
                                <input type="text" name="resistenciapozo" id="resistenciapozo" value="{{ old('resistenciapozo',$certificado->resistenciapozo)}}" class="form-control" placeholder="RESISTENCIA DE POZO">
                                <span class="input-group-text">Ohms</span>
                            </div>
                            @error('resistenciapozo')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="fechamedicion">FECHA DE MEDICIÓN (AÑOS) : </label>
                            <input type="date" placeholder="FECHA DE MEDICIÓN (AÑOS) :" class="form-control" name="fechamedicion" value="{{ old('fechamedicion',$certificado->fechamedicion)}}">
                            <input id="qr" name="qr" type="hidden" value="http://0.0.0.0/qrcode/{$id}">
                            @error('fechamedicion')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="vigenciamedicion">VIGENCIA DE MEDICIÓN (AÑOS) : </label>
                            <input type="number" placeholder="VIGENCIA DE MEDICIÓN (AÑOS) :" class="form-control" name="vigenciamedicion" value="{{ old('vigenciamedicion','1') }}">
                            <input id="qr" name="qr" type="hidden" value="http://0.0.0.0/qrcode/{$id}">
                            @error('vigenciamedicion')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card m-3 row justify-content-center text-primary p-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center">CONTROLES INICIALES</h5>
                </div>
                <div class="row card-body text-secondary">
                    <div class="form-group col-xs-12 col-md-4 ">
                        <label for="">FECHA</label>
                        <input type="date" class="form-control" name="vifecha" value="{{ old('vifecha',$certificado->vifecha)}}">
                        @error('vifecha')
                        <br>
                        <div class="valida">*{{ $message }}</div>
                        <br>
                        @enderror
                    </div>
                    <div class="form-group col-xs-12 col-md-4">
                        <label for="">HORA</label>
                        <input type="time" class="form-control" name="vihora" value="{{ old('vihora',$certificado->vihora)}}">
                        @error('vihora')
                        <br>
                        <div class="valida">*{{ $message }}</div>
                        <br>
                        @enderror
                    </div>
                    <div class="form-group col-xs-12 col-md-4">
                        <label for="">VALOR DE MEDICIÓN (OHMS)</label>
                        <div class="input-group mb-3">

                            <input type="text" name="vimedicion" id="vimedicion" class="form-control" value="{{ old('vimedicion',$certificado->vimedicion)}}">
                            <span class="input-group-text">OMHS</span>
                            </br>
                            @error('vimedicion')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-header bg-primary text-white">
                    <h5 class="text-center">CONTROLES FINALES</h5>
                </div>
                <div class="row card-body text-secondary">
                    <div class="form-group col-xs-12 col-md-4 ">
                        <label for="">FECHA</label>
                        <input type="date" class="form-control" name="vffecha" value="{{ old('vffecha',$certificado->vffecha)}}">
                        @error('vffecha')
                        <br>
                        <div class="valida">*{{ $message }}</div>
                        <br>
                        @enderror
                    </div>
                    <div class="form-group col-xs-12 col-md-4">
                        <label for="">HORA</label>
                        <input type="time" class="form-control" name="vfhora" value="{{ old('vfhora',$certificado->vfhora)}}">
                        @error('vfhora')
                        <br>
                        <div class="valida">*{{ $message }}</div>
                        <br>
                        @enderror
                    </div>
                    <div class="form-group col-xs-12 col-md-4 ">
                        <label for="">VALOR DE MEDICIÓN (OHMS)</label>
                        <div class="input-group mb-3">
                            <input type="text" name="vfmedicion" id="vfmedicion" class="form-control" value="{{ old('vfmedicion',$certificado->vfmedicion)}}">
                            <span class="input-group-text">OMHS</span>
                            @error('vfmedicion')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card m-3 row justify-content-center text-primary p-3" >
                <div class="card-header bg-primary text-primary">
                    <h4>IMÁGENES</h4>
                </div>
                <div class="form-group col-xs-12 col-md-12">
                    <BR>
                    <label for="">FOTO PARA EL CERTIFICADO</label>
                    <input type="file" class="form-control-file" name="fotocertif" value="{{ old('fotocertif') }}">

                    @error('fotocertif')
                    <br>
                    <div class="valida">*{{ $message }}</div>
                    <br>
                    @enderror
                </div>
                <div class="card-body text-primary">
                    <label for="imagenes">AÑADIR IMÁGENES</label>
                    <input class="form-control-file" id="imagenes[]" name="imagenes[]" type="file" multiple accept="image/*" >
                    <div class="description text-secondary">
                        Se puede subir un número ilimitado de imágenes<br>
                        Límite de 2MB por imágen<br>
                        Tipos permitidos jpeg, jpg, png, gif y svg.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4" style="margin-right: 20%;margin-left: 20%;margin-bottom: 5%;">
            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
        </div>
    </div>

</form>

@if ($errors->any())
@foreach ($errors->all() as $error)
<div>{{$error}}</div>
@endforeach
@endif

<div class="showimages">


    <div class="card-head col-12">
        <h4 class="text-center"> IMÁGENES CARGADAS:</h4>
    </div>


    <div class="row card-body">






        <div class="card card-primary">
            <div class="card-header">
                <h4 class="card-title">Galeria de Imágenes</h4>
            </div>
            <div id="listaimagenes" class="card-body">
                <div class="row">
                    @foreach($certificado->images as $image)
                    <div class="col-sm-2">
                        <a href="../../imagenes/{{ $image->url }}" data-toggle="lightbox"  data-title="Id: {{ $image->id }}"  data-gallery="gallery">
                            <img src="../../imagenes/{{ $image->url }}" class="img-fluid mb-2"/>
                        </a>
                        <br>
                        <a href="{{ $image->url }}">
                            <i class="fas fa-trash-alt" style="color:red"></i>
                        </a>
                    </div>
                    {{ $image->id }}
                    @endforeach


                </div>
            </div>
        </div>


    </div>
</div>

@endsection


@section("js")
<script>

    function colocar_cip() {
        let cip = $("#firma option:selected").attr("cip");
        $("#cip").val(cip);

    }

    $(document).ready(function () {
        $("input[name=varillaestado]").change(function(){

                if($("#varillaobs").is(':checked')){
                    $("#observacionesvarilla").show();
                }else{
                    $("#observacionesvarilla").hide();
                }
            }



        );


        $("input[name=cajaestado]").change(function(){

            if($("#cajaobs").is(':checked')){
                $("#observacionescaja").show();
            }else{
                $("#observacionescaja").hide();
            }
        });

        $("input[name=conectorestado]").change(function(){

            if($("#conectorobs").is(':checked')){
                $("#observacionesconector").show();
            }else{
                $("#observacionesconector").hide();
            }
        });

        $("input[name=cableestado]").change(function(){

            if($("#cableobs").is(':checked')){
                $("#observacionescable").show();
            }else{
                $("#observacionescable").hide();
            }
        });
    });




</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('grabado')=='ok')
<script>
    Swal.fire(
        'Certificado Creado!',
        'Tu certificado ha sido creado. Revisa la Vista Previa',
        'success'
    )
</script>
@endif

<script type="text/javascript">


    jQuery(document).ready(function()
    {
        jQuery('select[name="departamento"]').on('change', function(){
            var departamentoID = jQuery(this).val();
            if(departamentoID)
            {
                jQuery.ajax({
                    url : '/getProvincia/' +departamentoID,
                    type : "GET",
                    dataType : "json",
                    success : function(data)
                    {
                        jQuery('select[name="provincia"]').empty();
                        jQuery.each(data, function(key,value){
                            $('select[name="provincia"]').append('<option value="'+ value +'">'+ value+ '</option>');
                        });
                    }
                });
            }
            else
            {
                $('select[name="provincia"]').empty();
            }
        });


        jQuery('select[name="provincia"]').on('change', function(){
            var provinciaID = jQuery(this).val();
            if(provinciaID)
            {
                jQuery.ajax({
                    url : '/getDistrito/' +provinciaID,
                    type : "GET",
                    dataType : "json",
                    success : function(data)
                    {
                        jQuery('select[name="distrito"]').empty();
                        jQuery.each(data, function(key,value){
                            $('select[name="distrito"]').append('<option ubigeo="{{$distrito->ubigeo}}" value="'+ value +'">'+ value+'</option>');
                        });
                    }
                });
            }
            else
            {
                $('select[name="distrito"]').empty();
            }
        });
    });


    function colocar_ubigeo() {
        let ubigeo = $("#distrito option:selected").attr("ubigeo");
        $("#ubigeo").val(ubigeo);

    }



</script>







<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('select').select2();
    });

    //Uso de Lightbox
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({

            alwaysShowClose: true
        });
    });


</script>
@endsection
