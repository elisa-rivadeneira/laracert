@extends('firma.ubigeo')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="text-center">Multi Dropdown</h2>
        </div>

        <div class="row panel-body">
            <div class="col-md-3">
                <select class="form-control form-select" name="departamento" id="departamento">
                    <option selected="false">Departamento</option>

                    @foreach($departamentos as $departamento)
                        <option value="{{$departamento->nombre}}">{{$departamento->nombre}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select class="form-control form-select" name="provincia" id="provincia">
                    <option selected="false">Provincias</option>

                    @foreach($provincias as $provincia)
                        <option value="{{$provincia->departamento_id}}">{{$provincia->nombre}}</option>

                    @endforeach
                </select>


            </div>

            <div class="col-md-3">
                <select class="form-control form-select" name="distrito" id="distrito" onchange="colocar_ubigeo()">
                    <option selected="false">Distritos...</option>
                        @foreach($distritos as $distrito)
                        <option value="{{$distrito->provincia_id}}" ubigeo="{{$distrito->ubigeo}}">{{$distrito->nombre}}</option>

                        @endforeach
                    </option>


                </select>
            </div>



            <div class="col-md-3">

                <div class="input-group">
                    <label for="ubigeo" class="input-group-text"> UBIGEO: </label>
                    <input class="form-control" name="ubigeo" id="ubigeo" readonly>
                </div>
            </div>


        </div>

    </div>
@endsection

@section('scripts')

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
                            $('select[name="distrito"]').append('<option ubigeo="{{$distrito->ubigeo}}" value="'+ key +'">'+ value+'</option>');
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

@endsection
