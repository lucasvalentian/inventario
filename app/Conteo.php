<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conteo extends Model
{
    //

    protected $table='conteo';
    protected $primarykey='id';
    public $timestamps=true;
    protected $fillable=['contador','hora','fecha','estado','id_almacen','hora_fin','fecha_fin','id_usuario','usuario'];


}
