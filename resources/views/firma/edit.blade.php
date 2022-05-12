@extends('adminlte::page')


@section('title', ' Editar Colegiado')

@section('css')

    <style>
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
    <h1>Crear Colegiado</h1>
@stop

@section("content")
    <div class="row">

    </div>

    <form action="/firma/{{$firma->id}}" method="post" enctype="multipart/form-data" class="grabado">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-head">
                        <h4 class="text-center">DATOS DEL COLEGIADO</h4>

                    </div>
                    <div class="row card-body">
                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="{{old('nombre',$firma->nombre)}}">

                            @error('nombre')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>

                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">CIP</label>
                            <input type="text" class="form-control" name="cip" value="{{old('cip',$firma->cip)}}">
                            @error('cip')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>

                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">ESPECIALIDAD</label>
                            <input type="text" class="form-control" name="especialidad" value="{{old('especialidad',$firma->especialidad)}}">
                            @error('especialidad')
                            <br>
                            <div class="valida">*{{ $message }}</div>
                            <br>
                            @enderror
                        </div>

                        <div class="form-group col-xs-12 col-md-12">
                            <label for="">COLEGIATURA</label>
                            <span><br><a href={{ URL::asset($firma->colegiaturafile) }} > Ver Documento de Colegiatura</a></span>
                            <br><label for="">REEMPLAZAR</label>
                            <input type="file" class="form-control-file" name="colegiaturafile" value="{{old('colegiaturafile',$firma->colegiaturafile)}}" >
                        </div>
                        <div class="card">
                            <div class="card-head"> IMÁGENES</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label for=""><h4>FOTOGRAFIA</h4></label><br>
                                            <img id="imagenfoto" class="img-fluid img-thumbnail" src="/imagenes/firmas/{{$firma->id}}-foto.jpg" width="200px;">
                                                 </div>
                                    <div class="form-group col-xs-12 col-md-4 align-middle">
                                        <label for=""><h4>IMAGEN DE FIRMA</h4></label><br>
                                        <div class="align-middle" ><img id="imagenfirma" src="/imagenes/firmas/{{$firma->id}}-firma.jpg" width="200px;"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12 col-md-4 align-middle">
                                        <label for="">REEMPLAZAR</label>
                                        <input type="file" type="file" class="form-control-file"  name="fotopic" value="{{old('fototopic',$firma->fototopic)}}" onchange="loadFile1(event)" >
                                    </div>
                                    <div class="form-group col-xs-12 col-md-4">
                                        <label for="">REEMPLAZAR</label>
                                        <input type="file" class="form-control-file" name="firmapic" value="{{old('firmapic',$firma->firmapic)}}" onchange="loadFile2(event)" >
                                    </div>
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

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif

@endsection

@section("js")

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select').select2();
        });

        var loadFile1 = function(event) {
            var image1 = document.getElementById('imagenfoto');
            image1.src = URL.createObjectURL(event.target.files[0]);
        };

        var loadFile2 = function(event) {
            var image2 = document.getElementById('imagenfirma');
            image2.src = URL.createObjectURL(event.target.files[0]);
        };


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
