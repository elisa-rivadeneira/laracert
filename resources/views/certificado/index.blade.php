@extends('adminlte::page')


@section('title', 'Certificados')

@section('content_header')
    <h1>Administración de Certificados de Pozo a Tierra</h1>
@stop

@section('content')


    <a href="certificado/crear" class="btn btn-primary mb-4">CREAR</a>

    <table id="certificados" class="display responsive nowrap table table-striped mt-4 shadow-lg " style="width:100%" >
    <thead class="bg-primary text-white">
    <th scope="col">ID</th>
    <th scope="col">Cliente</th>
    <th scope="col">Firma</th>
    <th scrop="col">Vigencia</th>
    <th scrop="col">Fecha de Emisión</th>
    <th scrop="col">Acciones</th>
    </thead>

    <tbody>
    @foreach ($certificados->sortByDesc('id') as $certificado)

        <tr>
            <td>{{ $certificado->id}}</td>
            <td>{{ $certificado->cliente}}</td>
            <td>{{ $certificado->firma_certificado->nombre}}</td>
            <td>{{ \Carbon\Carbon::parse($certificado->vffecha)->age >= $certificado->vigenciamedicion ? 'NO VIGENTE' : 'VIGENTE' }}</td>
            <td>{{ \Carbon\Carbon::parse($certificado->vffecha)->format('d/m/Y')}}</td>
            <td>
                <form action="{{route ('certificados.destroy', $certificado->id) }}" method="POST" class="formelimi">
                    <a href="/certificados/{{$certificado->id}}/edit" class="btn btn-info"> Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" >Borrar</button>
                    <a href="/certificado/{{$certificado->id}}/pdf" class="btn btn-info"> PDF </a>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>
@stop

@section('css')
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet">

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
                'El certificado ha sido borrado',
                'success'
            )
        </script>

    @endif

    <script>



        $('.formelimi').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Esta acción no se podrá desacer",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrarlo!'
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


    <script>
        $(document).ready(function() {
            $('#certificados').DataTable({
                responsive: true,
                "lengthMenu":[[5,10,20,50,-1], [5,10,20,50,"All"]],
                "order": [[ 3, "desc" ]]
            });
        } );
    </script>
@stop

