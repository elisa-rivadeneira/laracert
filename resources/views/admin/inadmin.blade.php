@extends('adminlte::page')


@section('title', 'Admin Pozo a Tierra')

@section('content_header')
    <h1>Ingenieros Responsables del Sistema Pozo a Tierra</h1>
@stop

@section('content')


    <a href="/firmas/create" class="btn btn-primary mb-4">CREAR</a>

    <table id="certificados" class="display small responsive nowrap table table-striped mt-4 shadow-lg " style="width:100%" >
    <thead class="bg-primary text-white">
    <th scope="col" style="width:5%;">ID</th>
    <th scope="col" style="width:10%; text-align: center">Foto</th>
    <th scope="col" style="width:20%;">Nombre</th>
    <th scrop="col" style="width:10%;">CIP</th>
    <th scrop="col" style="width:10%;">Certif. Emitid.</th>
    <th scrop="col" style="width:10%;">Colegiatura</th>
    <th scrop="col" style="width:10%;">Firma</th>
    <th scrop="col" style="width:25%;">Acción</th>

    </thead>

    <tbody>

    @foreach ($items as $item)


        <tr>
            <td>{{ $item->id}}</td>
            <td><a class="thumbnail" data-toggle="modal" data-target="#fotopic{{$item->id}}" ><img src="imagenes/firmas/{{ $item->id}}-foto.jpg" width="50px"></a></td>
            <td>{{ $item->nombre}}</td>
            <td>{{ $item->cip}}</td>
            <td>{{ $item->CertificadosEmitidos}} </td>
            <td>    <div class="row" data-toggle="modal" data-target="#colegiaturapic">
                    @if($item->colegiaturafile)
                        <a href="{{ URL::asset($item->colegiaturafile) }}">Ver</a>
                    @else
                            No disponible
                    @endif


                </div></td>
            <td>  <div class="row" data-toggle="modal" data-target="#firmapic{{$item->id}}">
                    <a class="thumbnail" data-toggle="modal" data-target="#firmapic{{$item->id}}" ><img data-toggle="modal" src="imagenes/firmas/{{ $item->id}}-firma.jpg" width="50px"></a>
                </div></td>

            <td>   <!-- Button trigger modal -->
            <!--   <form action="{{route ('firmas.destroy', $item->id) }}" method="POST" class="formulariodeborrar"> -->
                    <a href="/certificado/firma/{{$item->id}}/" class="btn btn-info">Certif.</a>
                    <a href="/firmas/{{$item->id}}/edit" class="btn btn-info"> Editar</a>
                    @csrf
                    @method('DELETE')
                    <!-- <button type="submit" class="btn btn-danger" >Borrar</button> -->

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                        Borrar
                    </button>



                </form>
            </td>
        </tr>


        <div class="modal fade" id="colegiaturapic{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="text-align:center;">
                        <h5 class="modal-title" style="font-weight: bold;">COLEGIATURA DE {{ $item->nombre}}</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="text-align: center">
                        <img  src="imagenes/firmas/{{ $item->id}}-colegiatura.jpg" >                </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="fotopic{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="text-align:center;">
                        <h5 class="modal-title" style="font-weight: bold;">IMAGEN DE {{ $item->nombre}}</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="text-align: center">
                        <img  src="imagenes/firmas/{{ $item->id}}-foto.jpg" >                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="firmapic{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="text-align:center;">
                        <h5 class="modal-title" style="font-weight: bold;">FIRMA DE {{ $item->nombre}}</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="text-align: center">
                        <img  src="imagenes/firmas/{{ $item->id}}-firma.jpg" >                </div>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title" id="exampleModalLabel">Borrar Ingeniero</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <strong><h4>¿Estás seguro de borrar el ingeniero {{$item->nombre}}? </h4></strong><br>
                        Se borrará con todos sus certificados emitidos
                    </div>
                    <div class="modal-footer">
                        <form action="{{route ('firmas.destroy', $item->id) }}" method="POST" class="formulariodeborrar">
                            @csrf
                            @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Si, borrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    </tbody>
    </table>
@stop

@section('css')
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">



<style>
body{
    text-transform: uppercase;

}
</style>


@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    @if(session('eliminar')=='ok')
        <script>
            Swal.fire(
                'Borrado!',
                'El registro de ingeniero ha sido borrado',
                'success'
            )
        </script>

    @endif

    <script>






    <script>
        $(document).ready(function() {
            $('#certificados').DataTable({
                responsive: true,
                "lengthMenu":[[5,10,20,50,-1], [5,10,20,50,"All"]]
            });
        } );




    </script>






@stop

