<?php

namespace App\Http\Controllers;

use App\UserController;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\User;
use App\Almacen;
use Illuminate\Support\Facades\Auth;

class UserControllerController extends Controller
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


    public function index(Request $request)
    {
        //
        $datos = User::orderBy('id','DESC')->paginate(5);

        //print_r("");exit();

         return view('users.index',compact('datos'))
             ->with('i', ($request->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $almacen=Almacen::all();

        //print_r($almacen[0]);exit();
        return view('users.create',compact('almacen'));
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
        $this->validate($request, [
            'name' => 'required',
            //'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'id_almacen' => 'required',
            'username' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['id_almacen']=$request->id_almacen;
        $input['username']=$request->username;



        $user = User::create($input);

        return redirect()->route('users.index')
        ->with('success','User created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserController  $userController
     * @return \Illuminate\Http\Response
     */
    public function show(UserController $userController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserController  $userController
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        $almacen=Almacen::all();

        return view('users.edit',compact('user','almacen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserController  $userController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            //'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'id_almacen' => 'required',
        ]);
        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }

        $input['id_almacen']=$request->id_almacen;
        $input['username']=$request->username;
        $user = User::find($id);
        $user->update($input);
        $user->save($input);

        //print_r($input['id_almacen']);exit();


        return redirect()->route('users.index')
        ->with('success','User updated successfully');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserController  $userController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');



    }
}
