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
    <h1>Crear Registro de Telurómetro</h1>
@stop

@section("content")
    <div class="row">

    </div>
    <form action="/telurometro/{{$telurometro->id}}" method="post" enctype="multipart/form-data" class="grabado">
        @csrf
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">TELURÓMETROS</h1>
                <div class="card">
                    <div class="card-head">
                        <h5 class="text-center">DATOS DEL TELURÓMETRO</h5>
                    </div>
                    <div class="row card-body">
                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">NOMBRE</label>
                            <input type="text" class="form-control" name="nombre" value="{{old('nombre',$telurometro->nombre)}}">

                            @error('nombre')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>


                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">TIPO</label>
                            <input type="text" class="form-control" name="tipo" value="{{old('tipo',$telurometro->tipo)}}">

                            @error('tipo')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">MARCA</label>
                            <input type="text" class="form-control" name="marca" value="{{old('marca',$telurometro->marca)}}">

                            @error('marca')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">MODELO</label>
                            <input type="text" class="form-control" name="modelo" value="{{old('modelo',$telurometro->modelo)}}">

                            @error('modelo')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">SERIE</label>
                            <input type="text" class="form-control" name="serie" value="{{old('serie',$telurometro->serie)}}">

                            @error('serie')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="">FECHA DE CALIBRACIÓN</label>
                            <input type="date" class="form-control" name="fechacalib" value="{{old('fechacalib',$telurometro->fechacalib)}}">

                            @error('fechacalib')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>
                        <div class="form-group col-xs-12 col-md-6">
                            <label for="">VIGENCIA DE CALIBRACIÓN</label>
                            <input type="number" class="form-control" name="vigenciacalib" value="{{old('vigenciacalib',$telurometro->vigenciacalib)}}">

                            @error('vigenciacalib')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>









                    </div>
                </div>
            </div>
        </div>



        <div class="col-6" style="margin-right: 20%;margin-left: 20%;margin-bottom: 5%;">
            <button type="submit" class="btn btn-success btn-block">Guardar</button>
        </div>

        </div>


    </form>




    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif

@endsection


@section("js")
    <script>




        $(document).ready(function () {


        });


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
                title: 'Estás seguro?',
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
