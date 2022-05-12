<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Imagick;

class ImageController extends Controller
{
public function index($id)

    {
        $certificado=Certificado::find($id);
        $imgExt = new \Imagick();

        $imgExt->readImage(public_path('protocolos/protocolo-000'.$certificado->nombre.$certificado->id.'.pdf'));

        $imgExt->setResolution(300, 300);

        $imgExt->setBackgroundColor('white');

        $imgExt->setImageFormat('jpg');

        $imgExt->scaleImage(1500, 1500, true);

        $imgExt->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN);

        $imgExt->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
        $imgExt->writeImages('protocolos/protocolo-000'.$certificado->id.'.jpg', true);
        dd("Document has been converted");
    }
}
