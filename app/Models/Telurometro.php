<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telurometro extends Model
{
    use HasFactory;   protected $fillable = [
    'nombre',
    'tipo',
    'marca',
    'modelo',
    'serie',
    'fechacalib',
    'vigenciacalib',

 ];
}
