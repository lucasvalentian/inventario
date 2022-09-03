<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Resumen_conteo;
use Illuminate\Support\Facades\Auth;
use App\Productos;
use App\Almacen;
use App\Conteo;
use DB;

class ResumenConteoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('Modulo Usuarios');
    }

    public function index()
    {
        //

        return view('resumen.index');
    }

    public function conteo($cod_almacen){

        $conteo=Conteo::where('id_almacen','=',$cod_almacen)
        ->get();
        return response()->json($conteo);


    }

    //FUNCION PARA PODER ENVIAR LA DATA Y COMPARAR
    public function calcular($id_almacen,$num_fir,$num_two){

           $cantidades=DB::table('inventario as iv')
           ->join('productos as pr','pr.id','=','iv.id_producto')
           ->select('pr.id as id_productos','pr.codart','iv.id_almacen','iv.conteo',DB::raw('SUM(iv.conversion_unidad) as suma_unidades'))
           ->where('iv.conteo','=',$num_fir)
           ->where('iv.id_almacen','=',$id_almacen)
           //->where('pr.id','=',14526)
           ->groupBy('pr.codart','iv.id_almacen','iv.conteo','pr.id')
           ->get();





           foreach($cantidades as $can){

            $monto=$this->comparar($id_almacen,$num_two,$can->id_productos);




                $resumen=new Resumen_conteo;
                $resumen->id_alamcen=$id_almacen;
                //$resumen->conteo=$num_fir;
                $resumen->id_producto=$can->id_productos;
                $resumen->total_unidades=$can->suma_unidades;
                $resumen->llave='';

            if($monto==$can->suma_unidades){


                $producto=Productos::where('id','=',$can->id_productos)->first();

                if($id_almacen==1){

                    $producto->verificador_almacen_principal='X';
                    $resumen->condicion='X';

                }else if($id_almacen==2){

                    $producto->verificador_almacen_sur='X';
                    $resumen->condicion='X';

                }else if($id_almacen==3){

                    $producto->verificador_almacen_cajamarca='X';
                    $resumen->condicion='X';

                }//else{

                    //$producto->verificador_almacen_principal='';
                    //$producto->verificador_almacen_sur='';
                    //$producto->verificador_almacen_cajamarca='';


                //}

                $producto->save();


               }else{

                 $resumen->condicion='';


               }




               $resumen->save();
               //print_r($producto);exit();
//







            // print_r($can->id_productos);exit();


            //print_r($can->id_productos.' Monto= '.$monto);exit();



              //return  $this->comparar($id_almacen,$num_two,$can->id_productos);
           }


           return response()->json('OK');



    }

    public function comparar($id_almacen,$num_two,$cod_producto){


        $cantidad=DB::table('inventario as iv')
           ->join('productos as pr','pr.id','=','iv.id_producto')
           ->select('pr.id','pr.codart','iv.id_almacen','iv.conteo',DB::raw('SUM(iv.conversion_unidad) as suma_unidades'))
           ->where('iv.conteo','=',$num_two)
           ->where('iv.id_almacen','=',$id_almacen)
           ->where('pr.id','=',$cod_producto)
           ->groupBy('pr.codart','iv.id_almacen','iv.conteo','pr.id')
           ->get();

           $total=0;

           if(count($cantidad)>0){

            $total= $cantidad[0]->suma_unidades;

           }

           return $total;



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
