<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente',
        'agencia',
        'departamento',
        'provincia',
        'distrito',
        'ubigeo',
        'direccion',
        'firma',
        'telurometro',
        'pozoubicacion',
        'tipopozo',
        'longitudelectrodo',
        'conectadotablero',
        'otraopcionconectadotablero',
        'taparegistro',
        'otraopciontaparegistro',
        'electrodomaterial',
        'electrododiametro',
        'cajatipo',
        'cajaestado',
        'cajaobservacion',
        'conectortipo',
        'conectorestado',
        'conectorobservacion',
        'cabletipo',
        'cablediametro',
        'cableestado',
        'cableobservacion',
        'obsadicional',
        'metodomedicion',
        'resistenciapozo',
        'ubicacionspat',
        'vihora',
        'vifecha',
        'vimedicion',
        'vfhora',
        'vffecha',
        'vfmedicion',
        'qr',
        'nropozo',
        'vigenciamedicion',
        'fechamedicion',
        'images',
        'distanciapicau',
        'distanciapicad',
        'fotocertif'
    ];



    public function firma_certificado(){
        return $this->hasOne('App\Models\Firma','id','firma');
    }

    public function images(){
        return $this->morphMany('App\Models\Image','imageable');
    }

    public function scopeIdDescending($query)
    {
        return $query->orderBy('id','desc');
    }

    public function image(){
        return $this->morphOne('App\Models\Image','imageable');
    }


}
