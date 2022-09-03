<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resumen_conteo extends Model
{
    //

    protected $table='resume_conteo';
    protected $primarykey='id';
    public $timestamps=false;
    protected $fillable=['id_alamcen','conteo','id_producto','total_unidades',
    'condicion'];

}
