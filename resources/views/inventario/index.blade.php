@extends('layouts.admin')


@section('title')
  Inventario
@endsection

@section('style')
<!-- Sweet Alert-->
 <!-- twitter-bootstrap-wizard css -->
        <link rel="stylesheet" href="{{ asset('css/estilo.css') }}">

<!-- DataTables -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('contenidos')




<nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <h4>Listado de Almacenes</h4>
            </li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                <a href="{{url('inventario/create')}}" type="button" class="btn btn-success waves-effect btn-label waves-light" ><i class="bx bx-plus label-icon"></i> Agregar</a>

                <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>N° Conteo</th>
                                    <th>Almancen</th>
                                    <th>Codigo Economysa</th>
                                    <th>Producto</th>
                                    <th>Codio Barras</th>
                                    <th>Unidad venta</th>
                                    <th>Cantidad Unidades Contadas</th>
                                    <th>Unidad Master</th>
                                    <th>Cantidad Master Contadas</th>
                                    <th>Fecha/Hora</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="productos">
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>

                    <!--<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-6">
            <form id="regForm">
                <h1 id="register">Registro Inventario</h1>
                 <input type="hidden" id="codigo_unico_producto">
                <div class="all-steps" id="all-steps"> <span class="step"></span> <span class="step"></span> <span class="step"></span> <span class="step"></span> </div>
                <div class="tab">
                    <h3>Tipo de busquedad:</h3>
                    <label class="container">Codigo de Barras
                            <input type="radio" checked="checked" id="radio_barrar" name="radio">
                            <span class="checkmark"></span>
                    </label>
                    <label class="container">Nombre de Producto
                            <input type="radio" name="radio" id="radio_produto" data-bs-toggle="modal" data-bs-target="#modal_almacen">
                            <span class="checkmark"></span>
                    </label>
                    <p><input type="text" placeholder="Busqueda" id="busquedad" oninput="this.className = ''" name="Busqueda"></p>
                    <p><input type="text" placeholder="Codigo de Barras" id="barrar" oninput="this.className = ''" name="barrar"></p>

                </div>
                <div class="tab">
                    <p><input placeholder="Nombre del Producto" disabled id="producto" oninput="this.className = ''" name="first"></p>
                    <p><input placeholder="Codigo de Barras" disabled id="codigo_barras" oninput="this.className = ''" name="last"></p>


                </div>
                <div class="tab">
                    <p><input placeholder="Unidad de Medida" disabled id="unidad_minima" oninput="this.className = ''" name="email"></p>
                    <p><input placeholder="Cantidad en Unidades" id="cantidad_minima" oninput="this.className = ''" name="email"></p>
                    <p><input placeholder="Empq. Mast." disabled id="empaque" oninput="this.className = ''" name="email"></p>
                    <p><input placeholder="Cantidad en Master" id="cantidad_master" oninput="this.className = ''" name="phone"></p>
                </div>
                <div class="thanks-message text-center" id="text-message">
                    <h3>Muy bien!</h3> <span>Registro Exitoso!</span>
                </div>

                <div style="overflow:auto;" id="nextprevious">
                    <div style="float:right;"> <button type="button" id="prevBtn" onclick="nextPrev(-1)">Anterior</button> <button type="button" id="nextBtn" onclick="nextPrev(1)">Siguiente</button> </div>
                </div>
            </form>
        </div>
    </div>-->
</div>


    <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myExtraLargeModalLabel">Editar Linea</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                         <div class="row">
                                                            <input type="hidden" id="id_inventario">
                                                            <input type="hidden" id="id_producto">
                                                             <div class="col-lg-12">
                                                             <label for="">Codio Economysa</label>
                                                             <input type="text" class="form-control" id="cod_economysa" disabled >

                                                             <label for="">Producto</label>
                                                             <input type="text" class="form-control" id="producto" disabled >

                                                             <label for="">Codio Barras</label>
                                                             <input type="text" class="form-control" id="barras" disabled >
                                                             <label for="">Empaque Master</label>
                                                             <input type="text" class="form-control" id="empmaster" disabled >
                                                             <label for="">Cantidad Master</label>
                                                             <input type="text" class="form-control obligatorio" id="can_master"  >
                                                             <label for="">Unidad de Venta</label>
                                                             <input type="text" class="form-control " id="empmaster_unidad" disabled >
                                                             <label for="">Cantidad en Unidades</label>
                                                             <input type="text" class="form-control obligatorio" id="can_unidades"  >





                                                             </div>

                                                         </div>

                                                         <br><br>


                                                         <div class="pull-right">
                                                                       <button class="btn btn-primary" id="actualizar">Guardar</button>

                                                                </div>




                                                        </div>

                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->








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

<script src="{{asset('js/inventario.js')}}"></script>

@endsection
