@extends('layouts.admin')


@section('title')
  Editar Usuario
@endsection

@section('css')
<!-- Sweet Alert-->
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<!-- DataTables -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('contenidos')


    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Editar Usuario</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                            <li class="breadcrumb-item active">Detalle</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('users') }}" class="btn btn-success waves-effect btn-label waves-light" id="btnadd"><i class="dripicons-reply-all"></i> Atras</a>
                    </div>
                    <div class="card-body">

                    @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                    @endif

                    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id],'autocomplete'=>'off','files'=>'true']) !!}

                    <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                <input type="hidden" value="{{$user->id}}" name="id">
                                    <strong>Name:</strong>
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Password:</strong>
                                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Confirm Password:</strong>
                                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                                </div>
                            </div>


                            <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Seleccione la Sede</strong>
                                            <select name="id_almacen" id="id_almacen" class="form-control">
                                                <option value="">--Seleccionar--</option>
                                                @foreach($almacen as $a)
                                                   @if($a->id==$user->id_almacen)
                                                      <option value="{{$a->id}}" selected>{{$a->almacen}}</option>
                                                    @else
                                                    <option value="{{$a->id}}">{{$a->almacen}}</option>

                                                     @endif
                                                 @endforeach
                                            </select>

                                        </div>

                                    </div>




                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                               <br>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>








                    {!! Form::close() !!}




                    </div>
                </div>
            </div>
        </div>

      </div>

















@endsection
