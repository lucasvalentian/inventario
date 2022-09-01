urlgeeneral=$("#url_raiz_proyecto").val();
let codigo_categoria=0;

window.addEventListener("load", function (event) {

    $(".loader").fadeOut("slow");

     selector(0);
     datos();


  });

  //METODO PARA LLENAR LA TABLA DE DATOS
  function datos(){

    $.get(urlgeeneral+"/power-mantenimiento/listado",function(data){
        llenardata(data);
    });
  }


  function llenardata(data){

    var contenido = "";
    for (var i = 0; i < data.length; i++) {
        contenido += "<tr>";
        contenido += "<td style='padding:1px;text-align:center'>" +  parseInt(i+1,10) + "</td>";
        contenido += "<td style='padding:1px;text-align:center'>" + data[i].area + "</td>";
        contenido += "<td style='padding:1px;text-align:center'>" + data[i].Categoria + "</td>";
        contenido += "<td style='padding:1px;text-align:center'>" + data[i].titulo + "</td>";
        contenido += "<td style='padding:1px;text-align:center'>";
        contenido +='<a href="power-mantenimiento/'+data[i].id+'" type="button" target="_blank" class="btn btn-success "><i class="bx bxs-show label-icon"></i> </a>';
        contenido +=' <button type="button" onclick="abrimodal(\''+ data[i].id +'\')" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bx bx-pencil label-icon"></i> </button>';
        contenido +='<button type="button" onclick="eliminarsector(\''+ data[i].id +'\')" class="btn btn-danger eliminar"><i class="bx bxs-trash label-icon"></i></button>'

        contenido +="</td>";


        contenido += "</tr>";

    }

    document.getElementById("powerbi").innerHTML = contenido;
    $("#datatable").dataTable();


  }



//MOSTRAR DATOS EN EL MODAL
function abrimodal(id){

    if(id == "0"){

        limpiarcajasunidas();

        $("#guardar").show();
        $("#actualizar").hide();

      }else{

        $("#guardar").hide();
        $("#actualizar").show();

        $.get(urlgeeneral+"/power-mantenimiento/editar/"+id, function (data) {
            //console.log(data["Codigo"]);
            $("#valor").val(id);
            document.getElementById("titulo").value = data["titulo"];
            $("#frame").val(data["frame"]);
            selector( data["id_area"]);
            categorias(data["id_area"]);
            codigo_categoria=data["id_categoria"];




        });



      }
}



    //METODO PARA LLENAR EL SELECT
    function selector(valor)
    {

      $.get(urlgeeneral+"/matenimineto-areas/listado",function(data){

          var contenido = "";
          contenido +='<option value="">--Seleccionar--</option>';
          for (let index = 0; index < data.length; index++) {

           if(valor==data[index].id){

               contenido += "<option value='" + data[index].id + "' selected>" + data[index].name + "</option >";

           }else{

               contenido += "<option value='" + data[index].id + "' >" + data[index].name + "</option >";

           }


       }

       document.getElementById("id_area").innerHTML=contenido;



   });



    }

    //metodo paraa analizar el modal







    //metodo para llenar el otro select de las cateorias

    //METODO PARA LLENAR EL SELECT
    function categorias(valor)
    {

        //alert(valor);

      $.get(urlgeeneral+"/power-mantenimiento/categorias/"+valor,function(data){

          var contenido = "";
          contenido +='<option value="">--Seleccionar--</option>';
          for (let index = 0; index < data.length; index++) {

           if(codigo_categoria==data[index].id){

               contenido += "<option value='" + data[index].id + "' selected>" + data[index].name + "</option >";

           }else{

               contenido += "<option value='" + data[index].id + "' >" + data[index].name + "</option >";

           }


       }

       document.getElementById("id_categoria").innerHTML=contenido;



   });



    }


//METODO PARA GUARDAR LOS DATOS

//GUARDAR LOS DATOS DE SECTOR
$("#guardar").on("click",function(){

    if (datosobligatorio() == true) {

      var frm = new FormData();
      var csrf = document.querySelector('meta[name="csrf-token"]').content;

      var titulo=$("#titulo").val();
      var selectid_area = document.getElementById("id_area"); /*Obtener el SELECT */
      var id_area = selectid_area.options[selectid_area.selectedIndex].value;

      var selectid_categoria= document.getElementById("id_categoria"); /*Obtener el SELECT */
      var id_categoria = selectid_categoria.options[selectid_categoria.selectedIndex].value;

      var frame=$("#frame").val();



      frm.append("titulo", titulo);
      frm.append("frame", frame);
      frm.append("id_area", id_area);
      frm.append("id_categoria", id_categoria);
      frm.append("_token", csrf);

      $.ajax({
        type: "POST",
        url: urlgeeneral+"/power-mantenimiento/crear",
        data: frm,
        dataType: 'json',
        contentType: false,
        processData: false,
        success: function (data) {


                Swal.fire({
                    icon: 'success',
                    title: 'Oops...',
                    text: 'Creado Correctamente',
                    footer: ''
                })

                datos();
                $('#staticBackdrop').modal('hide');


           }
      });


    }
});


//MODIFICAR LOS DATOS
//MODIFICAR LOS SECTORES
$("#actualizar").on("click",function(){

    if (datosobligatorio() == true) {

              var frm = new FormData();
              var csrf = document.querySelector('meta[name="csrf-token"]').content;
              var titulo=$("#titulo").val();
              var selectid_area = document.getElementById("id_area"); /*Obtener el SELECT */
              var id_area = selectid_area.options[selectid_area.selectedIndex].value;

              var selectid_categoria= document.getElementById("id_categoria"); /*Obtener el SELECT */
              var id_categoria = selectid_categoria.options[selectid_categoria.selectedIndex].value;

              var frame=$("#frame").val();

              var id=$("#valor").val();

              frm.append("id", id);
              frm.append("titulo", titulo);
              frm.append("frame", frame);
              frm.append("id_area", id_area);
              frm.append("id_categoria", id_categoria);
              frm.append("_token", csrf);


              $.ajax({
                type: "POST",
                url: urlgeeneral+"/power-mantenimiento/editar",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: frm,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (data) {


                  Swal.fire({
                    icon: 'success',
                    title: 'Oops...',
                    text: 'Modificado Correctamente',
                    footer: ''
                  })

                  datos();
                  $('#staticBackdrop').modal('hide');
                  //console.log(data);

                  }
              });


    }

  });




  function eliminarsector(id){

    const tabla = document.getElementById('datatable');

      tabla.addEventListener('click', (e) => {
          if (e.target.classList.contains('eliminar') || e.target.classList.contains('bx')) {
              Swal.fire({
                  title: '¿Desea Anular el elemento?',
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
                      url: urlgeeneral+"/power-mantenimiento/eliminar/"+id,
                      data: {"_method": "delete",'_token': csrf},

                      success: function (data) {

                        datos();

                        Swal.fire(
                          'Eliminado!',
                          'La linea ha sido eliminado.',
                          'success'
                        )


                      }

                  });





                  }
                })
          }
      })



  }











//campos obligarotios

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
                text: 'El campo Area es Obligatorio!',
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

    //FUNCION LIMPIAR CAJAS DE INPUT
    function limpiarcajasunidas() {

      var controles = document.getElementsByClassName("limpiar");
      var ncontroles = controles.length;
      //alert(ncontroles);
      for (var i = 0; i < ncontroles; i++) {
          controles[i].value = "";
      }

  }
