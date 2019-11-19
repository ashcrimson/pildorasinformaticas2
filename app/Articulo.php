<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Articulo extends Model
{
    use SoftDeletes;
    protected $fillable=[
        "Nombre_Articulo",
        "Precio",
        "pais_origen",
        "observaciones",
        "seccion"
    ];

    public function cliente() {

        return $this->belongsTo('App\Cliente');
    }

    public function calificaciones()
    {
        return $this->morphMany('App\Calificaciones', 'calificacion');
    }
}
