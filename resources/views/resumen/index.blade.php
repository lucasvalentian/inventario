@extends('layouts.admin')
@section('title')
  Resumen Conteo
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
                    <div class="row">

                    <div class="col-md-3">
                        <label for="">Seleccionar Almacen</label>
                        <select name="" id="id_almacen_des" class="form-control" onchange="seleccionar_conteo(this.value)">

                        </select>

                    </div>
                    <div class="col-md-3">

                       <label for="">Seleccionar conteo Inicial</label>
                        <select name="" id="conteo_uno" class="form-control">

                        </select>

                    </div>

                    </div>

                <button type="button" class="btn btn-success waves-effect btn-label waves-light"  onclick="abrimodal(0)" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bx bx-plus label-icon"></i> Inicializar Comparación</button>

                </div>


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

<script src="{{asset('js/procesar.js')}}"></script>

@endsection
