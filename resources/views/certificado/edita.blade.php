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



        .valida{
            margin-top:-14px ;
            color: red;
            font-size: 11px;
        }

        @media screen and (max-width: 768px) {
            h1{
                font-size:18px;
                font-weight: bold;
            }
        }
    </style>
@stop



@section('content_header')
    <h1>Editar Certificado</h1>
@stop

@section("content")
    <div class="row">

    </div>
    <form action="/certificado/{{$certificado->id}}"" method="post">
        @csrf
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">PROTOCOLO DE PRUEBA DE SISTEMA DE PUESTA A TIERRA</h1>

                <div class="card">
                    <div class="card-head">
                        <h5 class="text-center">DATOS DEL SOLICITANTE</h5>

                    </div>
                    <div class="row card-body">
                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">Cliente</label>
                            <input type="text" class="form-control" name="cliente" value="{{old('cliente',$certificado->cliente)}}"">

                            @error('cliente')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>


@isset($certificado->agencia)
                        <div class="input-group col-xs-12 col-md-2">
                            <label for="" >TIENE AGENCIA</label>
                            <div class="col-sm-10 ">
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
                                <input type="text" class="form-control" name="agencia" value="{{ old('agencia') }}">
                                @error('agencia')
                                <br>
                                <div class="valida">*{{ $message }}</div>
                                <br>
                                @enderror
                            </div>

@endisset





                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">DIRECCIÓN</label>
                            <input type="text" class="form-control" name="direccion" value="{{old('direccion', $certificado->direccion)}}">
                            @error('direccion')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>

                    </div>
                </div>


                <div class="card">
                    <div class="card-head">
                        <h4>DATOS DEL COLEGIADO</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="form-group col-xs-12 col-md-4">
                                <label for="">Profesional Responsable</label>
                                <select id="firma" name="firma" class="form-control" onchange="colocar_cip()" value="{{ old('firma') }}">
                                    <option value="">Seleccione</option>
                                    @foreach($firmas as $value)
                                        <option especialidad="{{ $value->especialidad }}" cip="{{ $value->cip }}" value="{{ $value->id }}" {{ $value->id == $firma->id ? 'selected' : '' }}  ">{{ $value->nombre }}</option>
                                    @endforeach
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
                                <input id="cip" type="text" class="form-control" name="cip" value="{{$firma->cip}}" readonly>
                            </div>

                            <div class="form-group col-xs-12 col-md-4">
                                <label for="">Especialidad</label>
                                <input id="especialidad" type="text" class="form-control" name="especialidad" value="{{$firma->especialidad}}" readonly>


                            </div>
                        </div>

                    </div>

                </div>
                <div class="card">

                </div>


                <div class="card">
                    <div class="card-head">
                        <h4 class="text-center"> CARACTERÍSTICAS TÉCNICAS DEL SPAT</h4>
                    </div>

                    <div class="card-head">

                        <div class="row card-body">
                            <div class="col-3 input-group input-group-lg" style="margin-bottom: 15px;"></div>

                            <div class="form-group col-xs-12 col-md-12 col-lg-12">

                                <label for="" style="margin-right: 10px;">POZO A TIERRA NRO: </label>
                                <input type="number" class="form-control" name="nropozo" width="40px" value="1" >
                                @error('nropozo')
                                <br>
                                <div class="valida">*{{ $message }}</div>
                                <br>
                                @enderror

                            </div>



                            <div class="form-group col-xs-12 col-md-6 ">
                                <label for="">UBICACIÓN</label>
                                <input type="text" class="form-control" name="pozoubicacion" value="{{ old('pozoubicacion',$certificado->pozoubicacion) }}">
                                @error('pozoubicacion')
                                <br>
                                <div class="valida">*{{ $message }}</div>
                                <br>
                                @enderror
                            </div>

                            <div class="form-group col-xs-12 col-md-6 ">

                                <label for="">TIPO DE POZO</label>
                                <select id="tipopozo" name="tipopozo" class="form-control" value="{{ old('tipopozo', $certificado->tipopozo) }}" >
                                    <option value="">Seleccione</option>
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




                            <div class="form-group col-xs-6 col-md-6 col-lg-3">
                                <label for="">CONECTADO AL TABLERO DE</label>
                                <select id="conectadotablero" name="conectadotablero" class="form-control" value="{{ old('conectadotablero', $certificado->conectadotablero) }}" >
                                    <option value="">Seleccione</option>
                                    <option value="GENERAL" {{ old('conectadotablero', $certificado->conectadotablero) == "GENERAL" ? "selected" : "" }}>GENERAL</option>
                                    <option value="DISTRIBUCION" {{ old('conectadotablero', $certificado->conectadotablero ) == "DISTRIBUCION" ? "selected" : "" }}>DISTRIBUCIÓN</option>
                                    <option value="PRINCIPAL" {{ old('conectadotablero', $certificado->conectadotablero) == "PRINCIPAL" ? "selected" : "" }}>PRINCIPAL</option>
                                    <option value="ILUMINACION" {{ old('conectadotablero', $certificado->conectadotablero) == "ILUMINACION" ? "selected" : "" }}>ILUMINACIÓN</option>
                                    <option value="OTRO" {{ old('conectadotablero', $certificado->conectadotablero ) == "OTRO" ? "selected" : "" }} id="conectadotablerootro">OTRO</option>

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



                            <div class="form-group col-xs-12 col-md-6 col-lg-3">
                                <label for="">TAPA REGISTRO</label>
                                <select id="taparegistro" name="taparegistro" class="form-control" value="{{ old('taparegistro', $certificado->taparegistro) }}">
                                    <option value="" >Seleccione</option>
                                    <option value="PVC" {{ old('taparegistro', $certificado->taparegistro) == "PVC" ? "selected" : "" }} >PVC</option>
                                    <option value="BRONCE" {{ old('taparegistro', $certificado->taparegistro) == "BRONCE" ? "selected" : "" }} >BRONCE</option>
                                    <option value="CONCRETO" {{ old('taparegistro', $certificado->taparegistro) == "CONCRETO" ? "selected" : "" }} >CONCRETO</option>
                                    <option value="OTRO" {{ old('taparegistro', $certificado->taparegistro) == "OTRO" ? "selected" : "" }} id="taparegistrootro" >OTRO</option>


                                </select>


                                <div>
                                    @error('taparegistro')
                                    <br>
                                    <div class="valida">*{{ $message }}</div>
                                    <br>
                                    @enderror
                                </div>
                                <input type="text" name="otraopciontaparegistro" id="otraopciontaparegistro"  value="{{ old('otraopciontaparegistro', $certificado->otraopciontaparegistro) }}" style="display:none" class="form-control" aria-label="Alto" placeholder="Indicar el material de la tapa de registro ">

                            </div>
                            <div class="input-group-addon col-6">
                                <label for="">LONGITUD DE ELECTRODO</label>
                                <input type="text" name="longitudelectrodo" id="longitudelectrodo"  placeholder="longitud electrodo" class="form-control" value="{{ old('longitudelectrodo', $certificado->longitudelectrodo) }}" aria-label="Alto">

                                <div>
                                    @error('longitudelectrodo')
                                    <br>
                                    <div class="valida">*{{ $message }}</div>
                                    <br>
                                    @enderror
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="row card-body">

                        <div class="form-group col-xs-12 col-md-6">

                            <label for="">MATERIAL DE ELECTRODO</label>

                            <select id="electrodomaterial" name="electrodomaterial" class="form-control" value="{{ old('electrodomaterial', $certificado->electrodomaterial) }}">
                                <option value="">Seleccione</option>
                                <option value="Cobre (Cu) " {{ old('electrodomaterial', $certificado->electrodomaterial) == "Cobre (Cu)" ? "selected" : "" }}>Cobre (Cu)"</option>
                                <option value="Copperweld" {{ old('electrodomaterial', $certificado->electrodomaterial) == "Copperweld" ? "selected" : "" }}>Copperweld"</option>

                            </select>

                            <div>
                                @error('electrodomaterial')
                                <br>
                                <div class="valida">*{{ $message }}</div>
                                <br>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-xs-12 col-md-6">

                            <label for="">DIAMETRO DE ELECTRODO</label>

                            <select name="electrododiametro" class="form-control" value="{{ old('electrododiametro', $certificado->electrododiametro) }}">
                                <option value="{{ old('electrododiametro', $certificado->electrododiametro) }}">Seleccione</option>
                                <option value="VARILLA DE 1/2" {{ old('electrododiametro', $certificado->electrododiametro) == "VARILLA DE 1/2" ? "selected" : "" }}>VARILLA DE 1/2"</option>
                                <option value="VARILLA DE 3/4" {{ old('electrododiametro', $certificado->electrododiametro) == "VARILLA DE 3/4" ? "selected" : "" }}>VARILLA DE 3/4"</option>
                                <option value="VARILLA DE 5/8" {{ old('electrododiametro', $certificado->electrododiametro) == "VARILLA DE 5/8" ? "selected" : "" }}>VARILLA DE 5/8"</option>

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
                            <select  name="cabletipo" class="form-control" value="{{ old('cabletipo', $certificado->cabletipo) }}">
                                <option value="{{ old('cabletipo') }}">Seleccione</option>
                                <option value="desnudo" {{ old('cabletipo', $certificado->cabletipo) == "desnudo" ? "selected" : "" }} >Cu Desnudo</option>
                                <option value="aislado" {{ old('cabletipo', $certificado->cabletipo) == "aislado" ? "selected" : "" }} >Cu Aislado</option>

                            </select>
                            <div>
                                @error('cabletipo')
                                <br>
                                <div class="valida">*{{ $message }}</div>
                                <br>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group col-xs-12 col-md-6">
                            <label for=""> DIAMETRO DEL CABLE CONDUCTOR</label>
                            <select  name="cablediametro" class="form-control" value="{{ old('cablediametro', $certificado->cablediametro) }}">
                                <option value="{{ old('cablediametro') }}">Seleccione</option>
                                <option value="25 mm2" {{ old('cablediametro', $certificado->cablediametro) == "25 mm2" ? "selected" : "" }} >25 mm2</option>
                                <option value="35 mm2" {{ old('cablediametro', $certificado->cablediametro) == "35 mm2" ? "selected" : "" }} >35 mm2</option>
                                <option value="50 mm2" {{ old('cablediametro', $certificado->cablediametro) == "50 mm2" ? "selected" : "" }} >50 mm2</option>
                                <option value="70 mm2" {{ old('cablediametro', $certificado->cablediametro) == "70 mm2" ? "selected" : "" }} >70 mm2</option>

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



                        <div class="input-group-addon col-6">
                            <label for="">CAJA DE REGISTRO</label>
                            <select name="cajatipo" class="form-control" value="{{ old('cajatipo', $certificado->cajatipo) }}" >
                                <option value="">Seleccione</option>
                                <option value="MATERIAL DE CONCRETO" {{ old('cajatipo', $certificado->cajatipo) == "MATERIAL DE CONCRETO" ? "selected" : "" }}>MATERIAL DE CONCRETO</option>
                                <option value="MATERIAL PVC" {{ old('cajatipo', $certificado->cajatipo) == "MATERIAL PVC" ? "selected" : "" }}>MATERIAL PVC</option>
                                <option value="OTRO" {{ old('cajatipo', $certificado->cajatipo) == "OTRO" ? "selected" : "" }} >OTRO</option>

                            </select>

                            <div>

                                @error('cajatipo')
                                <br>
                                <div class="valida">*{{ $message }}</div>
                                <br>
                                @enderror
                            </div>

                        </div>

                        <div class="input-group-addon col-6">
                            <label for="" >ESTADO</label>
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

                        <div class="form-group col-12" id="observacionescaja" style="display:none">

                            <div class="form-group ">
                                <label for=""> OBSERVACIONES </label>
                                <input type="text" class="form-control" name="cajaobservacion" value="-">
                            </div>


                        </div>
                        <div class="input-group-addon col-6">
                            <label for="">CONECTOR AB </label>
                            <select name="conectortipo" class="form-control" value="{{ old('conectortipo', $certificado->conectortipo) }}">
                                <option value="">Seleccione</option>
                                <option value="1/2“" {{ $certificado->conectortipo == "1/2“" ? "selected" : "" }}>1/2“ </option>
                                <option value="3/4“" {{ $certificado->conectortipo == "3/4“" ? "selected" : "" }}>3/4“</option>
                                <option value="5/8“" {{ $certificado->conectortipo == "5/8“" ? "selected" : "" }}>5/8“</option>

                            </select>

                            <div>
                                @error('conectortipo')
                                <br>
                                <div class="valida">*{{ $message }}</div>
                                <br>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group-addon col-6">
                            <label for="" >ESTADO</label>
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
                                <input type="text" class="form-control" name="conectorobservacion" value="-">
                            </div>


                        </div>




                        <div class="form-group col-12" id="observacionescable" style="display:none">

                            <div class="form-group ">
                                <label for=""> OBSERVACIONES </label>
                                <input type="text" class="form-control" name="cableobservacion" value="-">
                            </div>


                        </div>

                        <div class="form-group col-12">
                            <label for="">OBSERVACIONES ADICIONALES</label>
                            <input type="text" class="form-control" name="obsadicional" value="-">
                        </div>



                    </div>
                </div>

                <div class="card" >
                    <div class="card-head col-12">
                        <h4 class="text-center">LECTURA DE MEDICIÓN SPAT</h4>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-xs-6 col-md-6">
                                <label for="">METODO DE MEDICION</label>
                                <input id="metodomedicion" type="text" class="form-control"  name="metodomedicion" placeholder="METODO WERNNER" value="METODO WERNNER" readonly >
                            </div>

                            <div class="form-group col-xs-6 col-md-6">
                                <label for="">TELURÓMETRO</label>
                                <select name="telurometro" class="form-control" value="{{ old('telurometro', $telurometro->nombre) }}">
                                    <option value="">Seleccione</option>
                                    @foreach($telurometros as $value)
                                        <option value="{{ $value->id }}" {{ old('telurometro', $telurometro->id) == $value->id ? "selected" : "" }}>{{ $value->nombre }}</option>
                                    @endforeach
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
                                    <input type="text" id="distanciapicau" name="distanciapicau" class="form-control" value="{{ old('distanciapicau', $certificado->distanciapicau) }}"  placeholder="">
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
                                    <input type="text" id="distanciapicad" name="distanciapicad" class="form-control" value="{{ old('distanciapicad', $certificado->distanciapicau) }}" placeholder="">
                                    <span class="input-group-text">mt</span>
                                </div>
                            </div>
                            @error('distanciapicad')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12 col-md-6">
                                <label for="">RESISTENCIA DE POZO</label>

                                <div class="input-group mb-3">
                                    <input type="text" name="resistenciapozo" id="resistenciapozo" value="{{ old('resistenciapozo', $certificado->resistenciapozo) }}" class="form-control" >
                                    <span class="input-group-text">Ohms</span>


                                </div>
                                @error('resistenciapozo')
                                <br>
                                <div class="valida">*{{ $message }}</div>
                                <br>
                                @enderror
                            </div>
                            <div class="form-group col-xs-12 col-md-6">
                                <label for="vigenciamedicion">VIGENCIA DE MEDICIÓN (AÑOS) : </label>
                                <input type="number" class="form-control" name="vigenciamedicion" value="{{ old('vigenciamedicion', $certificado->vigenciamedicion,'1') }}">
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
            <DIV>

            </DIV>





        </div>

        </div>





        <div class="" >



        </div>

        <div class="card" >

            <div class="card-head col-12">
                <h5 class="text-center">CONTROLES INICIALES</h5>
            </div>

            <div class="row card-body">

                <div class="form-group col-xs-12 col-md-4 ">

                    <label for="">FECHA</label>
                    <input type="date" class="form-control" name="vifecha" value="{{ old('vifecha', $certificado->vifecha) }}">
                    @error('vifecha')
                    <br>
                    <div class="valida">*{{ $message }}</div>
                    <br>
                    @enderror
                </div>





                <div class="form-group col-xs-12 col-md-4">

                    <label for="">HORA</label>
                    <input type="time" class="form-control" name="vihora" value="{{ old('vihora', $certificado->vihora) }}">
                    @error('vihora')
                    <br>
                    <div class="valida">*{{ $message }}</div>
                    <br>
                    @enderror


                </div>


                <div class="form-group col-xs-12 col-md-4">
                    <label for="">VALOR DE MEDICIÓN (OHMS)</label>
                    <div class="input-group mb-3">

                        <input type="text" name="vimedicion" id="vimedicion" class="form-control" value="{{ old('vimedicion', $certificado->vimedicion) }}">
                        <span class="input-group-text">OMHS</span>
                        </br>
                        @error('vimedicion')
                        <br>
                        <div class="valida">*{{ $message }}</div>
                        <br>
                        @enderror
                    </div>


                </div>

                <div class="card-head col-xs-12 col-md-12">
                    <h5 class="text-center">CONTROLES FINALES</h5>
                </div>

                <div class="card-head col-xs-12 col-md-4">

                    <label for="">FECHA</label>
                    <input type="date" class="form-control" name="vffecha" value="{{ old('vffecha', $certificado->vffecha) }}">
                    @error('vffecha')
                    <br>
                    <div class="valida">*{{ $message }}</div>
                    <br>
                    @enderror


                </div>

                <div class="card-head col-xs-12 col-md-4">
                    <label for="">HORA</label>
                    <input type="time" class="form-control" name="vfhora" value="{{ old('vfhora', $certificado->vfhora) }}">
                    @error('vfhora')
                    <br>
                    <div class="valida">*{{ $message }}</div>
                    <br>
                    @enderror


                </div>


                <div class="card-head col-xs-12 col-md-4">
                    <label for="">VALOR DE MEDICIÓN (OHMS)</label>
                    <div class="input-group mb-3">
                        <input type="text" name="vfmedicion" id="vfmedicion" class="form-control" value="{{ old('vfmedicion', $certificado->vfmedicion) }}">
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
        <div class="card col-xs-12 col-md-12 col-md-12" style="padding:20px;  width=80%; text-align: center;">
            <h4>IMÁGENES</h4>

            <div class="card-body">
                <label for="imagenes">AÑADIR IMÁGENES</label>
                <input class="form-control-file" id="imagenes[]" name="imagenes[]" type="file" multiple accept="image/*" >
                <div class="description">
                    Se puede subir un número ilimitado de imágenes<br>
                    Límite de 2048 MB por imágen<br>
                    Tipos permitidos jpeg, jpg, png, gif y svg.
                </div>
            </div>

        </div>




        <div class="card col-xs-12 col-md-12">







        </div>

        <div class="col-6" style="margin-right: 20%;margin-left: 20%;margin-bottom: 5%;">
            <button type="submit" class="btn btn-success btn-block">Guardar</button>
        </div>

        </div>


    </form>

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
                    <div class="row"> imagenes vamos a verlas
                        @foreach($certificado->images as $image)
                            {{ $image->url }} hola hola
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





    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif

@endsection


@section("js")
    <script>
        function colocar_cip() {
            let cip = $("#firma option:selected").attr("cip");
            $("#cip").val(cip);

            let especialidad = $("#firma option:selected").attr("especialidad");
            $("#especialidad").val(especialidad);
        }



        $(document).ready(function () {
            $("input[name=varillaestado]").change(function(){

                if($("#varillaobs").is(':checked')){
                    $("#observacionesvarilla").show();
                }else{
                    $("#observacionesvarilla").hide();
                }
            });


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


            $("select[name=conectadotablero]").change(function(){

                if($("#conectadotablerootro").is(':checked')){
                    $("#otraopcionconectadotablero").show();
                }else{
                    $("#otraopcionconectadotablero").hide();
                }
            });

            $("select[name=taparegistro]").change(function(){

                if($("#taparegistrootro").is(':checked')){
                    $("#otraopciontaparegistro").show();
                }else{
                    $("#otraopciontaparegistro").hide();
                }
            });

            $("input[name=tieneagencia]").change(function(){

                if($("#sitieneagencia").is(':checked')){
                    $("#agencia").show();
                }else{
                    $("#agencia").hide();
                }
            });



        });

        function agregar_insumo() {
            let insumo_id = $("#insumos option:selected").val();
            let insumo_text = $("#insumos option:selected").text();
            let cantidad = $("#cantidad").val();
            let costo = $("#costo").val();
            if (cantidad > 0 && costo > 0) {
                $("#tblInsumos").append(`
                    <tr id="tr-${insumo_id}">
                        <td>
                            <input type="hidden" name="insumo_id[]" value="${insumo_id}" />
                            <input type="hidden" name="cantidades[]" value="${cantidad}" />
                            ${insumo_text}
                        </td>
                        <td>${cantidad}</td>
                        <td>${costo}</td>
                        <td>${parseFloat((parseFloat(cantidad)) * parseFloat(parseFloat(costo))).toFixed(2)}</td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="eliminar_insumo(${insumo_id}, ${parseInt(cantidad) * parseInt(costo)})">X</button>
                        </td>
                    </tr>
                `);
                let precio_total = $("#precio_total").val() || 0;
                $("#precio_total").val(parseFloat(parseFloat(precio_total) + parseFloat(cantidad) * parseFloat(costo)).toFixed(2));
            } else {
                alert("Se debe ingresar una cantidad o precio valido");
            }
        }
        function eliminar_insumo(id, subtotal) {
            $("#tr-" + id).remove();
            let precio_total = $("#precio_total").val() || 0;
            $("#precio_total").val(parseInt(precio_total) - subtotal);
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#imagenes').DataTable({
                responsive: true,
                "lengthMenu":[[5,10,20,50,-1], [5,10,20,50,"All"]]
            });

            $('#medicion').DataTable({
                responsive: true,
                "lengthMenu":[[5,10,20,50,-1], [5,10,20,50,"All"]]
            });
        } );
    </script>



    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $('.grabadjjo').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    /* Swal.fire(
                         'Deleted!',
                         'Your file has been deleted.',
                         'success'
                     )*/

                    this.submit();
                }
            })
        });

    </script>

@endsection
