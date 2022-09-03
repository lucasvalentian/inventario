@extends('layouts.admin')


@section('title')
  Crear Inventario
@endsection

@section('style')
<!-- Sweet Alert-->
 <!-- twitter-bootstrap-wizard css -->
        <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">

<!-- DataTables -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('contenidos')


<div class="loader" style="position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('{{asset('img/loader-meta.gif')}}') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;">

    <div class="col-md-12" id="myDIV">
        <div class="panel panel-default">
            <div class="panel-heading">Ball Pulse</div>
            <div class="panel-body loader-demo" style="margin-top:200px;">
                <h1 style="color: #186A3B;font-family: 'Jomhuria', cursive;text-align:center"></h1>
                <div class="ball-pulse">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-content">

<div class="container-fluid">

<!-- start page title -->
                 <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Nuevo Registro</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="#">Inventario</a></li>
                                    <li class="breadcrumb-item active">Nuevo</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header" style="background: #2C3E50 ;color: #fffdfd;">

                            <a href="{{url('inventario')}}" type="button" class="btn btn-success waves-effect btn-label waves-light" ><i class="dripicons-reply-all"></i>  Atras</a>

                            </p>
                            </div>

                            <div class="card-body">

                            <div class="row">
                                <h1>

                                @if($condicion==1)
                                        CONTEO CERRADO  N° {{$contador}}
                                @elseif($condicion==4)
                                     CONTEO AUN NO INICIALIZADO
                                  @else
                                  INICIALIZACION DE CONTEO : N° {{$contador}}

                                @endif











                                </h1>
                               <div class="col-md-6">
                               <input type="hidden" id="codigo_unico_producto">


                                    <h3 tyle="font-size:14px ;">Seleccionar Tipo de busqueda:</h3>
                                    <label class="container" tyle="font-size:14px;">Codigo de Barras
                                            <input type="radio" checked="checked" id="radio_barrar" name="radio">
                                            <span class="checkmark"></span>
                                    </label>
                                    <label class="container" style="font-size:16px ;">Nombre de Producto
                                            <input type="radio" name="radio" id="radio_produto" data-bs-toggle="modal" data-bs-target="#modal_almacen">
                                            <span class="checkmark"></span>
                                    </label>
                                    <p><input type="text" placeholder="Busqueda" id="busquedad" oninput="this.className = ''" name="Busqueda"></p>
                                    <p><input type="text" placeholder="Codigo de Barras" id="barrar" oninput="this.className = ''" name="barrar">
                                    <br><br>
                                    <button id="buscode">Buscar</button>

                                </p>



                                    <p><label for="">Nombre del Producto</label><input placeholder="Nombre del Producto" disabled id="producto"  name="first"></p>
                                    <p><label for="">Codigo de Barras</label><input placeholder="Codigo de Barras" disabled id="codigo_barras"  name="last">


                                    </p>







                               </div>
                               <div class="col-md-6">
                                <br><br><br>
                                <!--<div id="qr-reader" style="width: 600px"></div>
                                <p><input type="text" class="form-control" id="captura"></p>-->
                                <p><label for="">Empaque Master</label><input placeholder="Empq. Mast." disabled id="empaque"  name="email"></p>
                                 <p><label for="">Cantidad Master</label><strong style="color:red"> (Campo Obligatorio(*))</strong><input placeholder="Cantidad en Master" value="0"  id="cantidad_master" class="obligatorio" name="phone"></p>
                               <div id="ocultar">
                               <p><label for="">Unidad de Venta</label><input placeholder="Unidad de Medida" disabled id="unidad_minima"  name="email"></p>
                                <p><label for="">Cantidad en Unidades </label><strong style="color:red">(Campo Obligatorio(*))</strong><input placeholder="Cantidad en Unidades" value="0" id="cantidad_minima" class="obligatorio"  name="email"></p>
                                </div>

                                 <div style="float:right;"> <button type="button" id="nextBtn">Guardar</button> </div>

                               </div>

                            </div>

                            </div>




                        </div>
                    </div>
                </div>
</div>


    <!-- Modal -->
    <div class="modal fade" id="modal_almacen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleModal">Agregar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>

                <form id="form_almacen">

                    <div class="modal-body">

                    <div class="table-responsive">
                        <table id="dataproduct" class="table">
                            <thead>
                                <tr>
                                    <th>Codigo Economysa</th>
                                    <th>Producto</th>
                                    <th>Codio Barras</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="contenido">
                            </tbody>
                        </table>
                    </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="btnform">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



@endsection

@section('script')

<!-- Sweet Alerts js -->

<!-- Required datatable js -->
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
 <!-- twitter-bootstrap-wizard js -->
 <script src="assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <script src="assets/libs/twitter-bootstrap-wizard/prettify.js"></script>

<script src="assets/js/pages/form-wizard.init.js"></script>
<script src="https://unpkg.com/html5-qrcode@2.0.9/dist/html5-qrcode.min.js"></script>

<script src="{{asset('js/crear.js')}}"></script>

@endsection
