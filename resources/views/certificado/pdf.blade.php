<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Reporte en PDF</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <link href="/var/www/html/resources/css/bootcss.css" rel="stylesheet" type="text/css" />

    <style>
        .page-break {
            page-break-after: always;
        }



        table{
            border-collapse: collapse;
            font: 10px Arial, Helvetica, sans-serif;
        }
        table tr td.bor{
            border: 0.2px solid #000;
            border-collapse: collapse;

        }
        table tr td.sbl{
            border-top: 0.2px solid #000;
            border-right: 0.2px solid #000;
            border-bottom: 0.2px solid #000;
            border-left: 0px;
            border-collapse: collapse;

        }

        table tr td.sbr{
            border-top: 0.2px solid #000;
            border-left: 0.2px solid #000;
            border-bottom: 0.2px solid #000;
            border-right: 0px;
            border-collapse: collapse;

        }

        table tr td.sbb{
            border-top: 0.2px solid #000;
            border-right: 0.2px solid #000;
            border-bottom: 0px;
            border-left: 0.2px solid #000;
            border-collapse: collapse;

        }

        table tr td.sbt{
            border-top: 0px;
            border-right: 0.2px solid #000;
            border-bottom: 0.2px solid #000;
            border-left: 0.2px solid #000;
            border-collapse: collapse;

        }

        table tr td.capit{
            text-transform: capitalize;

        }


        tr{
            line-height: 23px ;
        }

        .ctr{
           text-align: center;
        }

        .maintitu{
            font-weight: bold;
            font-size:14px;
            font-family: "Arial, Helvetica, sans-serif";
        }

        .mayus{
            text-transform: uppercase ;
        }



        .tb{
            font-weight: bold;
            font-size:12px;
            font-family: "Arial, Helvetica, sans-serif";
        }

        body{
            padding: 5px 5px -0px 5px;
            font: 09px Arial, Helvetica, sans-serif;
            /*    text-transform: uppercase; */

        }



        #logo {
            position: absolute;
            top: -15px;
            left: 10px;

        }

        #cip {
            position: absolute;
            top: -20px;
            right: 10px;

        }

        .maintitle{
            padding: 1px;
            background-color: #dcdcdc;
            font: 14px Arial, Helvetica, sans-serif;
            position: relative;
            margin-bottom: 20px;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.125);
            border-radius: 0.25rem;
            text-align: center;
        }

        .titulotabla{
            padding: 10px;
            font-weight: bold ;
            font-size: 10.5px;
            background-color: rgba(0, 0, 0, 0.03);
        }





        .form-control {
            display: block;
            width: 100%;

        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }



        #cont{
            background-color: darkred;

        }


        #firma{
            position: absolute;
            margin-bottom:-30px ;
            margin-right: 26px;
            margin-left: 5px;
            width: 674px;

        }


        table {
            table-layout: fixed;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
            font-size: 10px;

        }

        table td, table th {

            padding:5px;


        }
        table .ultimalinea{
            border-collapse: collapse;
            border:none;

        }

        table td .ultimalinea  {
            border-collapse: collapse;
            border:none;

        }

        table td .lefta {
            text-align: left;

        }

        table td .derecha {
            text-align: center;
        }

        table td .center {
            margin:0 auto;
            text-align:center;
        }

        div::after {
            position: absolute;
            top: 2px;
            right: .5em;
            transition: all .05s ease-in-out;
        }

        /* move unit more to the left on hover
           for arrow buttons will appear to the right of number inputs */
        div:hover::after {
            right: 1.5em;
        }

        /* set the unit abbreviation for each unit class */
        .ms::after {
            content: 'ms';
        }

        #vertical-orientation {
            position:absolute;
            top:600px;
            left:-20px;

            transform: rotate(270deg);
            transform-origin: left top 0;
            padding: 5px;

            opacity: 0.9;
            font-size: 11px;
            width:100%;


        }

        .valida{
            margin-top: -20px;
            color: red;
            font-size: 6px;



        }

        small{
            color: red !important;
        }

        .errorseleccion{
            color: blue;
        }


    </style>

</head>

<body>


<div id="vertical-orientation ">
    Fecha de Generacion de reporte: {{ date('d-m-Y h:m:s' ) }}

</div>
<table style="width:100%; border-collapse: collapse">


                <tr>
                    <td colspan="5" class="bor" style="text-align: center""><img src='images/olinsa.jpg' style="width:140px; text-align: center">      </td>
                    <td colspan="7" class="ctr bor maintitu">  PROTOCOLO DE PRUEBA DE SISTEMA DE PUESTA A TIERRA</td>
                    <td colspan="5" class="ctr bor">{{$certificado->cliente}}</td>
                </tr>

                <tr>
                    <td colspan="5" class="bor" style="font-weight:bold;  padding-left: 10px;">PROPIETARIO</td>
                    <td colspan="12" class="bor"  style=" padding-left: 10px;">{{$certificado->cliente}}</td>
                </tr>
                @isset($certificado->agencia)
                    <tr>
                        <td colspan="5" class="bor"  style="font-weight:bold; border-bottom: 1px solid #c8c8c8; border-right: 1px solid #c8c8c8; border-collapse: collapse; padding-left: 10px;">AGENCIA</td>
                        <td colspan="12" class="bor"  style="padding-left: 10px;">{{$certificado->agencia}}</td>
                    </tr>
                @endisset
                <tr>
                    <td colspan="3" class="sbr"  >Dirección:<br> </td>
                    <td colspan="5" class="sbl" >{{$certificado->direccion}} <br> </td>
                    <td colspan="4" rowspan="2" class="bor" style="text-align: center" >CNE-60-712 </td>
                    <td colspan="5" rowspan="2"  class="bor" >Req:  OSINERGMIN / DEFENSA CIVIL  </td>
                </tr>
                <tr>
                    <td colspan="2" class="sbr" >Distrito:<br> </td>
                    <td colspan="6" class="mayus sbl">{{$certificado->distrito}} <br> </td>

                </tr>
<tr>
                    <td colspan="4" class="sbr">  Provincia/Departamento:</td>
                    <td colspan="6" class="mayus sbl" > {{$certificado->provincia}}/{{$certificado->departamento}}</td>
                    <td colspan="7"class="bor" >Fecha : {{ date('d-m-Y') }}</td>




                </tr>

                <tr>
                    <td colspan="17" class="tb bor"> 1 .- Datos Generales y Medidas   </td>

                </tr>
<tr>

    <td colspan="5" class=" bor">  Cliente: <br> {{$certificado->cliente}}</td>
    <td colspan="6" class=" bor"> Método de Medición Empleado: <span class="mayus"><b>{{$certificado->metodomedicion}}</b></span><br>
        Equipo Utilizado:<b> {{$telurometro->nombre}}</b></td>
    <td colspan="6" class=" bor">Mediciones y Certificación.: OLINSA S.A.<br>

        Telf: 01 -3763206 - 956194726
    </td>

</tr>

<tr style="line-height: 15px; class=" bor">

    <td colspan="3" class="sbb" style="text-align: center; border-bottom:none;">SISTEMA DE MEDICION <BR>  </td>
    <td colspan="3" class="sbb" style="text-align: center; border-bottom:none;">DISTANCIAS REFERENCIALES (62%) <BR>
    </td>
    <td colspan="3" class="sbb" style="text-align: center">VALOR RESISTENCIA (R) <BR>
    </td>
    <td colspan="2" class="sbb" style="text-align: center">FRECUENCIA <BR> </td>
    <td colspan="3" class="sbb" style="text-align: center">FECHA DE MEDICIÓN <br> </td>
    <td colspan="3" class="sbb" style="text-align: center">TEMPERATURA AMBIENTE<BR></td>
</tr>

    <tr style="text-align: center">
        <td colspan="3" class="sbt"><B>Caída de Potencial </B><br> </td>
        <td colspan="3" class="sbt"><b>Elect(I):{{$certificado->distanciapicau}}<br>
                Elect(P):{{$certificado->distanciapicad}}
            </b>
        </td>
        <td colspan="3" class="sbt"><b>{{$certificado->resistenciapozo}} Ohmn</b>
        </td>
        <td colspan="2" class="sbt"><B>270 HZ</B></td>
        <td colspan="3" class="sbt"><b>{{$certificado->fechamedicion}}</b></td>
        <td colspan="3" class="sbt"><B>23º</B></td>
    </tr>
    <tr >
        <td colspan="17" class="tb sbt"> 2 .- Características Técnicas   </td>

    </tr>
    <tr style="line-height: 15px; border-bottom:none;">

        <td colspan="3" style="text-align: CENTER;" class="bor">

POZO A TIERRA
            </td>
        <td colspan="7" class="bor" style="text-align: center; border-bottom:none;">ELECTRODO DE PUESTA A TIERRA/PAT N°01<BR>
        </td>
        <td colspan="5" class="bor" style="text-align: center">ACOMETIDA DEL PAT <BR>
        </td>
        <td colspan="2" class="bor" style="text-align: center">TAPA DE       REG <BR> </td>
>
    </tr>

    <tr  style="text-align: center">
        <td colspan="3" class="bor" style="text-align: left">
            <ul style="padding-left: 12px;">
                <li>Tierra de Cultivo</li>
                <li>Sales Electrolíticas</li>
                <li>Geles</li>
                <li>Cemento Conductivo</li>
            </ul></td>
        <td colspan="2" class="bor">Material <br>{{$certificado->electrodomaterial}}<br>

            </b>
        </td>
        <td colspan="2" class="bor">Diam.(Plg) <br> {{$certificado->electrododiametro}}
        </td>
        <td colspan="1" class="bor">L (m)<br>{{$certificado->longitudelectrodo}} </td>
        <td colspan="2" class="bor capit">Tipo de Instalación
           {{$certificado->tipopozo}}</td>
        <td colspan="2" class="bor">Diámetro de Cable<br>{{$certificado->cablediametro}} </td>
        <td colspan="3" class="bor">Conductor de Cu.
            {{$certificado->cabletipo}}
        </td>
        <td colspan="2" class="bor capit" >
            {{$certificado->taparegistro}}
        </td>
    </tr>
<tr>
    <td colspan="4" class="sbr"><B>OBS. ADICIONALES: </B></td>
    <td colspan="13" class="sbl">{{$certificado->obsadicional}}</td>

</tr>
    <tr>
        <td colspan="17" class="bor"><b>3.-CONCLUSIONES</b><BR>
           <i><b><span class="maintitu">CONFORME.</span></b></i> <br>
            <span><i>La medición de la "RESISTENCIA" a la dispersión eléctrica del S.P.A.T,. CUMPLE con las normas establecidas por el Código Nacional de Electricidad 2006, regla 60-712 .PERU: Sección 060 - Pags. 27/36 - Sistema de Utilización y los requerimientos solicitados por el OSINERGMIN / DEFENSA CIVIL.</i>
            </span>
        </td>
    </tr>
<tr>

    <td colspan="17" class="bor"><b>4. VIGENCIA DEL PROTOCOLO :</b> Desde {{ \Carbon\Carbon::parse($certificado->vffecha)->format('d/m/Y')}} hasta {{ \Carbon\Carbon::parse($certificado->vffecha)->addYear()->format('d/m/Y');}}</td>

</tr>
    <tr>

        <td colspan="6" class="bor center"  style="text-align: center; ">

                <img  src="imagenes/certificados/{{ $certificado->id}}-fotocertif.jpg"  height="120px">


                </td>
        <td colspan="8" class="bor center" style="text-align: center; vertical-align: text-top;">
            <b>6. FIRMA DEL PROFESIONAL RESPONSABLE</b><br>
            @foreach ($sqlfirmas as $sqlfirma)
                <div style="text-align: center;"><img src={{ $sqlfirma->url }} style="height:60px"><br>
                    ING.  {{ $firma->nombre}} (CIP :   {{ $firma->cip}})
                </div>

            @endforeach
        </td>

        <td colspan="3" class="bor" style="text-align: center; vertical-align: text-top;" ><b>7. CÓDIGO QR</b><BR> <img src="data:image/png;base64, {!! $qrcodigo !!}">



    </tr>



</table>












</body>
</html>
