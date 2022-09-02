@extends('layouts.admin')


@section('title')
  Usuarios
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

                <button type="button" class="btn btn-success waves-effect btn-label waves-light"  onclick="abrimodal(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bx bx-plus label-icon"></i> Inicializar Conteo</button>

</div>
<div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Almacen</th>
                                    <th>Hora Incio</th>
                                    <th>Fecha Incio</th>
                                    <th>Conteo</th>
                                    <th>Hora fin</th>
                                    <th>Fecha Fin</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="conteo">
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                             <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Formulario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                             </div>
                        <div class="modal-body">
                            <input type="hidden" name="name" id="valor" value="0" />
                            <input type="hidden" name="name" id="id_almacen" value="0" />

                            <div class="form-group">

                            <h1 style="color:crimson">INICIALIZAR CONTEO</h1>
                            <label for="">Seleccionar Almacen</label>
                            <select name="" id="id_almacen_des" class="form-control">


                            </select>


                            </div>

                        </div>
                        <div class="modal-footer">
                         <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                         <button type="button" class="btn btn-primary" id="guardar">Iniciar</button>
                         <button type="button" class="btn btn-primary" id="actualizar">Finalizar</button>
                       </div>
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

<script src="{{asset('js/conteo.js')}}"></script>

@endsection
