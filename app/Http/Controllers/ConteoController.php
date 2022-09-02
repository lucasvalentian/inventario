<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Conteo;
use Illuminate\Support\Facades\Auth;
use App\Almacen;
use DB;

class ConteoController extends Controller
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
        $almacenes=Almacen::all();

        return view('conteo.index',compact('almacenes'));
    }

    public function almacenes(){

            $almacenes=Almacen::all();

            return response()->json($almacenes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listado(){

         $inicializador=DB::table('conteo as c')
         ->join('almacen as a','a.id','=','c.id_almacen')
         ->select('c.id','a.almacen','c.contador','c.hora','c.fecha','c.estado','c.id_almacen','c.hora_fin','c.fecha_fin',
            'c.id_usuario','c.usuario')
         ->get();

         return response()->json($inicializador);
    }
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
    public function crear(Request $request)
    {
        //

        $des=0;
        $user = Auth::user();
       // $conteo=Conteo::where('id_almacen','=',$request->id_almacen)
        //->where('estado','=',0)
        //->first();


        //$des=$des + $conteo->contador;
       // return response()->json($des+$conteo->contador);


        //if($conteo==null){
            $monto=$this->conexion($request->id_almacen);

            $conteo=new Conteo;
            $conteo->contador=$monto+1;
            $conteo->estado=0;
            $conteo->id_almacen=$request->id_almacen;
            $conteo->hora=date("H:i:s");
            $conteo->fecha=Date('Y-m-d');
            $conteo->id_usuario=$user->id;
            $conteo->usuario=$user->name;
            $conteo->save();

            return response()->json($conteo);




       // }

        //$conteo=new Conteo;



    }
    public function conexion($id_almacen){

        $conteo=Conteo::where('id_almacen','=',$id_almacen)
        ->where('estado','=',1)->get();

        $ultimo=$conteo->last();

        $contador=0;

        if($ultimo==null){

            $contador=$contador;

        }else{

            $contador=$ultimo->contador;

        }

        return $contador;

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
        $conteo=Conteo::find($id);

        return response()->json($conteo);

    }

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
        $des=0;
        $user = Auth::user();


            $conteo=Conteo::find($request->id);;
            //$conteo->contador=1;
            $conteo->estado=1;
            $conteo->id_almacen=$request->id_almacen;
            $conteo->hora_fin=date("H:i:s");
            $conteo->fecha_fin=Date('Y-m-d');
            $conteo->id_usuario=$user->id;
            $conteo->usuario=$user->name;
            $conteo->save();

            return response()->json('OK');





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
