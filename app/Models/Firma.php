<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    use HasFactory;    protected $fillable = [
    'nombre',
    'cip',
    'especialidad',
    'colegiaturafile',
    'fotopic',
    'firmapic'

];
    public function certificados(){
        return $this->belongsToMany('App\Models\Certificado');
    }

    public function image(){
        return $this->morphOne('App\Models\Image','imageable');
    }


}
