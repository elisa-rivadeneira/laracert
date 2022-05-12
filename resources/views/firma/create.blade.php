@extends('adminlte::page')


@section('title', 'Firmas')

@section('css')
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">
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
    <h1>Crear Colegiados</h1>
@stop

@section("content")
    <div class="row">

    </div>
    <form action="/firmas" method="post" enctype="multipart/form-data" class="grabado">
        @csrf
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">INGENIEROS RESPONSABLES</h1>

                <div class="card">
                    <div class="card-head">
                        <h5 class="text-center">DATOS DEL COLEGIADO</h5>

                    </div>
                    <div class="row card-body">
                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}">

                            @error('nombre')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>

                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">CIP</label>
                            <input type="text" class="form-control" name="cip" value="{{ old('cip') }}">

                            @error('cip')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>

                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">ESPECIALIDAD</label>
                            <input type="text" class="form-control" name="especialidad" value="{{ old('especialidad') }}">

                            @error('especialidad')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>

                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">FOTOGRAFIA</label>
                            <input type="file" class="form-control" name="fotopic" value="{{ old('fotopic') }}">

                            @error('fotopic')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>

                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">IMAGEN DE FIRMA</label>
                            <input type="file" class="form-control" name="firmapic" value="{{ old('firmapic') }}">

                            @error('firmapic')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>

                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">ARCHIVO DE COLEGIATURA</label>
                            <input type="file" class="form-control" name="colegiaturafile" value="{{ old('colegiaturafile') }}">

                            @error('colegiaturafile')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>




                    </div>
                </div>



                </div>






                    </div>

                </div>





                <div class="" >



                </div>






            <div class="col-6" style="margin-right: 20%;margin-left: 20%;margin-bottom: 5%;">
                <button type="submit" class="btn btn-success btn-block">Guardar</button>
            </div>

        </div>


    </form>

    <div class="showimages">


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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select').select2();
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
