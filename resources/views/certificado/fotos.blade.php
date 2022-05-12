<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Fotografías del SPAT</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link href="/var/www/html/resources/css/bootcss.css" rel="stylesheet" type="text/css" />

    <style>
        .page-break {
            page-break-after: always;
        }

        table{
            border-collapse: collapse;
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


    </style>

</head>

<body>

<div class="card-head" style="text-align: center; margin-bottom: 40px;">
    <h3> REGISTRO FOTOGRÁFICO DEL SISTEMA DE PUESTA A TIERRA</h3>
    <br><br>
</div>


<div style="text-align: center">



    @foreach($certificado->images as $image)

        <img src="imagenes/{{ $image->url }}" height="350px" />
        <?php



        ?>


    @endforeach




</div>







