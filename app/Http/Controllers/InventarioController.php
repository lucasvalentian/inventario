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
            ->select('al.id','al.almacen','p.producto','p.codigo_barras','p.undpresenta','i.stock_unidades','p.empaquevta',
                'i.stock_master','i.fecha_prevista','i.hora','p.codart')
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
        return view('inventario.create');
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



        $user = Auth::user();

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


        $inventario->save();
        return response()->json($inventario);
        print_r('');exit();



        return response()->json('OK');





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
