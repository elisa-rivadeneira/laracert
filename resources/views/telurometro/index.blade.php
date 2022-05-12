@extends('adminlte::page')


@section('title', 'Admin Pozo a Tierra')

@section('content_header')
    <h1>TELUROMETROS</h1>
@stop

@section('content')


    <a href="/telurometros/create" class="btn btn-primary mb-4">CREAR</a>

    <table id="certificados" class="display responsive nowrap table table-striped mt-4 shadow-lg " style="width:100%" >
    <thead class="bg-primary text-white">
    <th scope="col" style="width:5%;">ID</th>
    <th scope="col" style="width:20%;">Nombre</th>
    <th scope="col" style="width:20%;">Tipo</th>
    <th scope="col" style="width:20%;">Marca</th>
    <th scope="col" style="width:20%;">Modelo</th>
    <th scope="col" style="width:20%;">Serie</th>
    <th scope="col" style="width:20%;">Fecha de Calibración</th>
    <th scope="col" style="width:20%;">Vigencia de Caibración</th>
    <th scrop="col" style="width:25%;">Acción</th>

    </thead>

    <tbody>

    @foreach ($items as $item)


        <tr>
            <td>{{ $item->id}}</td>
            <td>{{ $item->nombre}}</td>
            <td> {{ $item->tipo}} </td>
            <td> {{ $item->marca}} </td>
            <td> {{ $item->modelo}} </td>
            <td> {{ $item->serie}} </td>
            <td> {{ $item->fechacalib}} </td>
            <td> {{ $item->vigenciacalib}} </td>


            <td>   <!-- Button trigger modal -->
                <form action="{{route ('telurometros.destroy', $item->id) }}" method="POST" class="formelimi">




                    <a href="/telurometros/{{$item->id}}/edit" class="btn btn-info"> Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ">Borrar</button>
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
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        </script>

    @endif

    <script>
        $('.formelimi').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Estás seguro?',
                text: "No podrás deshacer ésta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, bórralo!'
            }).then((result) => {
                if (result.isConfirmed) {
                   /* Swal.fire(
                        'Borrado!',
                        'Tu registro ha sido borrado',
                        'success'
                    )*/

                    this.submit();
                }
            })
        });

    </script>


    <script>
        $(document).ready(function() {
            $('#certificados').DataTable({
                responsive: true,
                "lengthMenu":[[5,10,20,50,-1], [5,10,20,50,"All"]]
            });
        } );




    </script>






@stop

