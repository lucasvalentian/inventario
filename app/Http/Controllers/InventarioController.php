<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Inventario;
use App\Productos;
use App\Almacen;
use Illuminate\Support\Facades\Date;
use Symfony\Component\VarDumper\Cloner\Data;
use Illuminate\Support\Facades\Auth;
use App\Conteo;

class InventarioController extends Controller
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
        return view('inventario.index');
    }

    public function contenido(){
        $productos=Productos::all();
        return response()->json($productos);

    }

    public function listarproductos(){

            $user = Auth::user();
            $productos=DB::table('inventario as i')
            ->join('productos as p','p.id','=','i.id_producto')
            ->join('almacen as al','al.id','=','i.id_almacen')
            ->select('i.id','al.id as id_almacen','al.almacen','p.producto','p.codigo_barras','p.undpresenta','i.stock_unidades','p.empaquevta',
                'i.stock_master','i.fecha_prevista','i.hora','p.codart','i.conteo')
            ->where('i.id_usuario','=',$user->id)
            ->get();

            return response()->json($productos);

    }
    public function codigo_barras($codigo)
     {

        $productos=Productos::where('codigo_barras','=',$codigo)->get();
        return response()->json($productos);


     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user = Auth::user();


             $condicion='';
             $contador=0;
             $user = Auth::user();


            $inicializador=DB::table('conteo as c')
            ->join('almacen as a','a.id','=','c.id_almacen')
            ->select('c.id','a.almacen','c.contador','c.hora','c.fecha','c.estado','c.id_almacen','c.hora_fin','c.fecha_fin',
               'c.id_usuario','c.usuario')
               //->where('c.id_usuario','=',$user->id)
               //->where('c.estado','=',0)
               ->where('a.id','=',$user->id_almacen)
               //->orderBy('id','desc')
               ->get();

               $ultimo=$inicializador->last();




               if($ultimo==null){
                  $condicion=4;

               }else if($ultimo->estado==1){

                      $condicion=$ultimo->estado;
                      $contador=$contador+$ultimo->contador;

               }else{

                        $condicion=0;
                        $contador=$ultimo->contador;
               }

               //print_r($condicion);exit();






        return view('inventario.create',compact('condicion','contador'));
    }

    //METODO PARA IMPEDIR GUARDAR LA INFORMACION



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function crear(Request $request)
    {
        //

        $user = Auth::user();
        $inicializador=DB::table('conteo as c')
        ->join('almacen as a','a.id','=','c.id_almacen')
        ->select('c.id','a.almacen','c.contador','c.hora','c.fecha','c.estado','c.id_almacen','c.hora_fin','c.fecha_fin',
           'c.id_usuario','c.usuario')
           ->where('a.id','=',$user->id_almacen)
           ->where('c.estado','=',0)
           ->get();

           $ultimo=$inicializador->last();
           $info=$this->impedir($user->id_almacen);

           $conversion=$this->conversion($request->id_producto);

           //return response()->json($conversion);


          if($info==1){

            return response()->json('error');


          }else if($info==4){

            return response()->json('dos');

          }else{

            $inventario=new Inventario;
            $inventario->concepto='Saldo Inicial';
            $inventario->id_almacen=$user->id_almacen;
            $inventario->tipo_operacion='Conteo Economysa';
            $inventario->id_producto=$request->id_producto;
            $inventario->stock_unidades=$request->stock_unidades;
            $inventario->stock_master=$request->stock_master;
            $inventario->fecha_prevista=Date('Y-m-d');
            $inventario->hora=date("H:i:s");
            $inventario->id_usuario=$user->id;
            $inventario->nombre=$user->name;
            $inventario->id_conteo=$ultimo->id;
            $inventario->conteo=$ultimo->contador;
            $inventario->conversion_unidad=($conversion*$request->stock_master)+$request->stock_unidades;



           // print_r('');exit();

            $inventario->save();

            //



            return response()->json('ok');

          }






    }

    //FUNCIONA PARA LA CONVERSION
    public function conversion($cod_producto){

        $productos=Productos::find($cod_producto);

        return $productos->unidad_conversion;


    }

    public function impedir($almacen){

        $condicion='';
        $contador=0;
        $user = Auth::user();


        $inicializador=DB::table('conteo as c')
        ->join('almacen as a','a.id','=','c.id_almacen')
        ->select('c.id','a.almacen','c.contador','c.hora','c.fecha','c.estado','c.id_almacen','c.hora_fin','c.fecha_fin',
            'c.id_usuario','c.usuario')
            //->where('c.id_usuario','=',$user->id)
            //->where('c.estado','=',0)
            ->where('a.id','=',$user->id_almacen)
            //->orderBy('id','desc')
            ->get();

        $ultimo=$inicializador->last();




        if($ultimo==null){
            $condicion=4;

        }else if($ultimo->estado==1){

                $condicion=$ultimo->estado;
                $contador=$contador+$ultimo->contador;

        }else{

                $condicion=0;
                $contador=$ultimo->contador;
        }

        return $condicion;

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
    public function editar($id)
    {
        //
        $user = Auth::user();

            $productos=DB::table('inventario as i')
            ->join('productos as p','p.id','=','i.id_producto')
            ->join('almacen as al','al.id','=','i.id_almacen')
            ->select('i.id','al.id as id_almacen','al.almacen','p.producto','p.codigo_barras','p.undpresenta','i.stock_unidades','p.empaquevta',
                'i.stock_master','i.fecha_prevista','i.hora','p.codart','p.id  as id_producto')
            ->where('i.id','=',$id)
            ->first();

            return response()->json($productos);



    }
    //FUNCION PARA MOSTRAR EL CONTEO EN LA LINEA

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //

        //return response()->json('hola');

        $user = Auth::user();
        $inicializador=DB::table('conteo as c')
        ->join('almacen as a','a.id','=','c.id_almacen')
        ->select('c.id','a.almacen','c.contador','c.hora','c.fecha','c.estado','c.id_almacen','c.hora_fin','c.fecha_fin',
           'c.id_usuario','c.usuario')
           ->where('a.id','=',$user->id_almacen)
           ->where('c.estado','=',0)
           ->get();

           $ultimo=$inicializador->last();


        $inventario=Inventario::find($request->id);
        $inventario->concepto='Saldo Inicial';
        $inventario->id_almacen=$user->id_almacen;
        $inventario->tipo_operacion='Conteo Economysa';
        $inventario->id_producto=$request->id_producto;
        $inventario->stock_unidades=$request->stock_unidades;
        $inventario->stock_master=$request->stock_master;
        $inventario->fecha_prevista=Date('Y-m-d');
        $inventario->hora=date("H:i:s");
        $inventario->id_usuario=$user->id;
        $inventario->nombre=$user->name;
        $inventario->id_conteo=$ultimo->id;
        $inventario->conteo=$ultimo->contador;
        $inventario->save();

        return response()->json($inventario);







    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function eliminar($id)
    {
        Inventario::find($id)->delete();
        return response()->json('OK');

     }
}
