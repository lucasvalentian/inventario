urlgeeneral=$("#url_raiz_proyecto").val();
$("#busquedad").hide();
var radio_barrar = document.getElementById('radio_barrar');
var radio_produto = document.getElementById('radio_produto');

const btn_add = document.getElementById('btnadd');
window.addEventListener("load", function (event) {

    //listarinfo();
    $(".loader").fadeOut("slow");
    productos();
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

  radio_barrar.addEventListener('click', function() {
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
  });



//  contenido += "<td style='padding:1px;text-align:center' id='predio"+data[i].id_predio+"'>" + data[i].id_predio + " <input type='hidden' id='id_sector"+data[i].id_predio+"' value='"+data[i].id+"'></td>";
function productos(){

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
}

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
            contenido += "</tr>";


        }


        document.getElementById("productos").innerHTML = contenido;
        $("#dataTableExample").dataTable();

    });


}


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
var currentTab = 0;
document.addEventListener("DOMContentLoaded", function(event) {


    showTab(currentTab);

});



function showTab(n) {
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
         console.log("uno");

    } else {
        document.getElementById("prevBtn").style.display = "inline";
        console.log("dos");

    }
    if (n == (x.length - 1)) {

        document.getElementById("nextBtn").innerHTML = "Guardar";
        console.log("tres");



    } else {
        document.getElementById("nextBtn").innerHTML = "Siguiente";
        console.log("cuatro");

    }
    fixStepIndicator(n)
}

function nextPrev(n) {
    var x = document.getElementsByClassName("tab");
    if (n == 1 && !validateForm()) return false;
    x[currentTab].style.display = "none";
    currentTab = currentTab + n;
    if (currentTab >= x.length) {
        // document.getElementById("regForm").submit();
        // return false;
        //alert("sdf");
        document.getElementById("nextprevious").style.display = "none";
        document.getElementById("all-steps").style.display = "none";
        document.getElementById("register").style.display = "none";
        document.getElementById("text-message").style.display = "block";

        //metodo para guardar el inventarioa

        var frm = new FormData();
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






    }
    showTab(currentTab);
}

function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    for (i = 0; i < y.length; i++) {
        if (y[i].value == "") {
            y[i].className += " invalid";
            valid = false;
        }
    }
    if (valid) { document.getElementsByClassName("step")[currentTab].className += " finish";console.log("seis"); }
    return valid;
}

function fixStepIndicator(n) {
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) { x[i].className = x[i].className.replace(" active", "");console.log("siete"); }
    x[n].className += " active";
}

//funcion para cargar los productos
