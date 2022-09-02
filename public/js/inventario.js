urlgeeneral=$("#url_raiz_proyecto").val();
$("#busquedad").hide();
//var radio_barrar = document.getElementById('radio_barrar');
//var radio_produto = document.getElementById('radio_produto');

//const btn_add = document.getElementById('btnadd');
window.addEventListener("load", function (event) {

    //listarinfo();
    $(".loader").fadeOut("slow");
    //productos();
    inventariado();
    //grafica();
    //totalclientes();
    /*listarareas();
    selector(0);

    $("#categoria, #slug").stringToSlug({
        callback: function(text){
            $('#slug').val(text);
        }
    });*/


  });

  /*radio_barrar.addEventListener('click', function() {
    if(radio_barrar.checked) {

        $("#busquedad").hide();
        $("#barrar").show();
        $("#barrar").val('');

    } else {
        $("#busquedad").show();
        $("#barrar").hide();
        $("#busquedad").val('');
    }
  });


  radio_produto.addEventListener('click', function() {
    if(radio_produto.checked) {
        $("#busquedad").show();
        $("#barrar").hide();
        $("#busquedad").val('');
    } else {

        $("#busquedad").hide();
        $("#barrar").show();
        $("#barrar").val('');
    }
  });*/



//  contenido += "<td style='padding:1px;text-align:center' id='predio"+data[i].id_predio+"'>" + data[i].id_predio + " <input type='hidden' id='id_sector"+data[i].id_predio+"' value='"+data[i].id+"'></td>";
/*function productos(){

    $.get(urlgeeneral+"/inventario/contenido",function(data){

        let contenido="";
        for (var i = 0; i < data.length; i++) {
            contenido += "<tr>";
            contenido += "<td style='padding:1px;text-align:center' id='codigo"+data[i].id+"'>" + data[i].codart  + "</td>";
            contenido += "<td style='padding:1px;text-align:center' id='producto"+data[i].id+"'>" + data[i].producto  + "</td>";
            contenido += "<td style='padding:1px;text-align:center' id='barras"+data[i].id+"'>" + data[i].codigo_barras  + " <input type='hidden' id='undpresenta"+data[i].id+"' value='"+data[i].undpresenta+"'>  <input type='hidden' id='empaquecompra"+data[i].id+"' value='"+data[i].empaquecompra+"'> </td>";
            contenido += "<td style='padding:1px;text-align:center'>";

            contenido +='<a href="#" onclick="seleccionar('+data[i].id+')" type="button" class="btn btn-success "><i class="bx bxs-show label-icon"></i> Seleccionar </a>';

            contenido +="</td>"

            contenido += "</tr>";


        }


        document.getElementById("contenido").innerHTML = contenido;
        $("#dataproduct").dataTable();

    });
}*/

//CARGAR LOS PRODUCTOS YA INVENTARIADOS
function inventariado(){

    $.get(urlgeeneral+"/inventario/listarproductos",function(data){

        let contenido="";
        for (var i = 0; i < data.length; i++) {
            contenido += "<tr>";
            contenido += "<td style='padding:1px;text-align:center' id='codigo"+data[i].id+"'>" + data[i].almacen  + "</td>";
            contenido += "<td style='padding:1px;text-align:center' id='producto"+data[i].id+"'>" + data[i].codart  + "</td>";
            contenido += "<td style='padding:1px;text-align:center' id='producto"+data[i].id+"'>" + data[i].producto  + "</td>";
            contenido += "<td style='padding:1px;text-align:center' id='barras"+data[i].id+"'>" + data[i].codigo_barras  + " </td>";
            contenido += "<td style='padding:1px;text-align:center' id='barras"+data[i].id+"'>" + data[i].undpresenta  + " </td>";
            contenido += "<td style='padding:1px;text-align:center' id='barras"+data[i].id+"'>" + data[i].stock_unidades  + " </td>";
            contenido += "<td style='padding:1px;text-align:center' id='barras"+data[i].id+"'>" + data[i].empaquevta  + " </td>";
            contenido += "<td style='padding:1px;text-align:center' id='barras"+data[i].id+"'>" + data[i].stock_master  + " </td>";
            contenido += "<td style='padding:1px;text-align:center' id='barras"+data[i].id+"'>" + data[i].fecha_prevista + ' - '+ data[i].hora + " </td>";
            contenido += "<td style='padding:1px;text-align:center'>";
            contenido +=' <button type="button" onclick="abrimodal(\''+ data[i].id +'\')" class="btn btn-info " data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bx bx-pencil label-icon"></i></button>';
            contenido +='<button type="button" onclick="eliminarsector(\''+ data[i].id +'\')" class="btn btn-danger eliminar"><i class="bx bxs-trash label-icon"></i></button>'

            contenido +="</td>";
            contenido += "</tr>";


        }


        document.getElementById("productos").innerHTML = contenido;
        $("#dataTableExample").dataTable();

    });


}

//METODO PARA MODIFICAR LA LINEA

function abrimodal(id){

     $(".bs-example-modal-xl").modal("show");

     $.get(urlgeeneral+"/inventario/editar/"+id,function(data){

        $("#id_inventario").val(id);
        $("#cod_economysa").val(data.codart);
        $("#producto").val(data.producto);
        $("#barras").val(data.codigo_barras);
        $("#empmaster").val(data.empaquevta);
        $("#can_master").val(data.stock_master);
        $("#empmaster_unidad").val(data.undpresenta);
        $("#can_unidades").val(data.stock_unidades);
        $("#id_producto").val(data.id_producto);



     });


}



$("#actualizar").on("click",function(){

    if (datosobligatorio() == true) {

              var frm = new FormData();
              var csrf = document.querySelector('meta[name="csrf-token"]').content;
              var id=$("#id_inventario").val();
              var stock_unidades=$("#can_unidades").val();
              var stock_master=$("#can_master").val();
              var id_producto=$("#id_producto").val();

              frm.append("_token", csrf);
              frm.append("id", id);
              frm.append("stock_unidades", stock_unidades);
              frm.append("stock_master", stock_master);
              frm.append("id_producto", id_producto);
              alert(stock_unidades+"  "+stock_master+"  "+id);

              $.ajax({
                type: "POST",
                url: urlgeeneral+"/inventario/modificar",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: frm,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (data) {

                    //console.log(data);


                  Swal.fire({
                    icon: 'success',
                    title: 'Oops...',
                    text: 'Modificado Correctamente',
                    footer: ''
                  })

                  inventariado();
                  $('.bs-example-modal-xl').modal('hide');
                  //console.log(data);

                  }
              });


    }

  });






//METODO PARA LLAMAR DATOS POR EL CODIGO DE BARRAS
$("#barrar").on("keyup",function(){


       let barrar=$("#barrar").val();

         $.get(urlgeeneral+"/inventario/codigo_barras/"+barrar,function(data){


            $("#producto").val(data[0].producto);
            $("#codigo_barras").val(data[0].codigo_barras);
            $("#unidad_minima").val(data[0].undpresenta);
            $("#empaque").val(data[0].empaquevta);
            $("#codigo_unico_producto").val(data[0].id);

         });

});

//METODO PARA LLENAR LOS DATOS+
function seleccionar(id){

      $("#busquedad").val($("#producto"+id).text());
      $("#producto").val($("#producto"+id).text());
      $("#codigo_barras").val($("#barras"+id).text());
      $("#unidad_minima").val($("#undpresenta"+id).val());
      $("#empaque").val($("#empaquecompra"+id).val());
      $("#codigo_unico_producto").val(id);

      $("#modal_almacen").modal("hide");


    Swal.fire({
        icon: 'success',
        title: 'Oops...',
        text: 'Producto Seleccionado Correctamente',
        footer: ''
    })

}


  //your javascript goes here




        //metodo para guardar el inventarioa

      /*  var frm = new FormData();
        var csrf = document.querySelector('meta[name="csrf-token"]').content;
        var id_producto=$("#codigo_unico_producto").val();
        var stock_unidades=$("#cantidad_minima").val();
        var stock_master=$("#cantidad_master").val();

        frm.append("_token", csrf);
        frm.append("id_producto", id_producto);
        frm.append("stock_unidades", stock_unidades);
        frm.append("stock_master", stock_master);

        $.ajax({
            type: "POST",
            url: urlgeeneral+"/inventario/crear",
            data: frm,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (data) {

                console.log(data);
                location.href =urlgeeneral+"/inventario";


              Swal.fire({
                icon: 'success',
                title: 'Oops...',
                text: 'Creado Correctamente',
                footer: ''
              })

                //listarbeneficiario();
                //$('#staticBackdrop').modal('hide');


               }
          });


*/


//funcion para cargar los productos
function eliminarsector(id){
    alert(id);

    const tabla = document.getElementById('dataTableExample');

      tabla.addEventListener('click', (e) => {
          if (e.target.classList.contains('eliminar') || e.target.classList.contains('bx')) {
              Swal.fire({
                  title: '¿Desea eliminar el registro?',
                  text: "No podrás revertir esto!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Si, eliminar!',
                  cancelButtonText: 'Cancelar'
                }).then((result) => {
                  if (result.isConfirmed) {
                  //Metodo para eleminar
                  var csrf = document.querySelector('meta[name="csrf-token"]').content;
                    $.ajax({
                      type: "POST",
                      url: "inventario/eliminar/"+id,
                      data: {"_method": "delete",'_token': csrf},

                      success: function (data) {

                        inventariado();

                        Swal.fire(
                          'Eliminado!',
                          'Registro eliminado.',
                          'success'
                        )


                      }

                  });





                  }
                })
          }
      })



  }

  function datosobligatorio() {
    var bien = true;

    var obligarotio = document.getElementsByClassName("obligatorio");
    var ncontroles = obligarotio.length;

    for (var i = 0; i < ncontroles; i++) {
        if (obligarotio[i].value == "") {
            bien = false;
            //alert("vacios");
            //obligarotio[i].parentNode.classList.add("form-control error");
            //swal("Here's a message!")
            //swal("Error!", "Los Campos Son Obligatorios!", "error")
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Todos los Campos son Obligatorios!',
                footer: ''
              })
            //alert("Campos Obligatorios");
            //swal("Error!", "Los Campos Marcados de Rojo son requeridos!", "error")
            //alert("Los datos son Obliatorios");


        } else {
            obligarotio[i].parentNode.classList.remove("error")
        }
    }
    return bien;

    }
