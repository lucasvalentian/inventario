<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    //
    protected $table='inventario';
    protected $primarykey='id';
    public $timestamps=false;
    protected $fillable=['concepto','id_almacen','tipo_operacion','id_producto',
    'stock_unidades','stock_master','fecha_prevista','hora','id_usuario','nombre','id_conteo','conteo',
      'conversion_unidad','conteo_condicion','fecha_vencimiento','observacion'];



}
