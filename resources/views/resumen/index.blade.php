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
                    <div class="col-md-3">

                       <label for="">Seleccionar conteo Inicial</label>
                        <select name="" id="conteo_dos" class="form-control">

                        </select>

                    </div>
                    <div class="col-md-3">
                        <br>
                       <button type="button" class="btn btn-success waves-effect btn-label waves-light"  onclick="procesar()" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bx bx-plus label-icon"></i> Inicializar Comparación</button>

                    </div>


                    </div>



                </div>


                </div>
            </div>

        </div>
    </div>



    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content" >
                             <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Generando Comparación de Conteo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                             </div>
                        <div class="modal-body">

                        <div class="row">


                                                      <div class="col-lg-2 col-xs-12"></div>
                                                      <div class="col-lg-8 col-xs-12">

                                                      <img src="{{asset('img/loader-meta.gif')}}" style=""  alt="" class="" width="100%" >
                                                            <h4 style="text-align: center;color:#BA4A00">Espere Porfovar Mientras se general la comparación...</h4>
                                                            <p style="text-align: center;color:#BA4A00">Mientras tanto tome una tasa de cafe <i class=" fas fa-coffee"></i></p>

                                                      </div>
                                                      <div class="col-lg-2 col-xs-12"></div>

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
