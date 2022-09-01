urlgeeneral=$("#url_raiz_proyecto").val();


window.addEventListener("load", function (event) {

    //listarinfo();
    $(".loader").fadeOut("slow");
    //grafica();
    //totalclientes();
    listarareas();
    selector(0);

    $("#categoria, #slug").stringToSlug({
        callback: function(text){
            $('#slug').val(text);
        }
    });


  });

  function listarareas(){

     $.get(urlgeeneral+"/matenimineto-categorias/listado",function(data){

         llenardata(data);

     })
  }

  function llenardata(data){

    var contenido = "";
    for (var i = 0; i < data.length; i++) {
        contenido += "<tr>";
        contenido += "<td style='padding:1px;text-align:center'>" +  parseInt(i+1,10) + "</td>";
        contenido += "<td style='padding:1px;text-align:center'>" + data[i].area + "</td>";
        contenido += "<td style='padding:1px;text-align:center'>" + data[i].categoria + "</td>";
        contenido += "<td style='padding:1px;text-align:center'>";

        contenido +=' <button type="button" onclick="abrimodal(\''+ data[i].id +'\')" class="btn btn-info " data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bx bx-pencil label-icon"></i> </button>';
        contenido +='<button type="button" onclick="eliminarsector(\''+ data[i].id +'\')" class="btn btn-danger eliminar"><i class="bx bxs-trash label-icon"></i></button>'

        contenido +="</td>";


        contenido += "</tr>";

    }

    document.getElementById("areaslist").innerHTML = contenido;
    $("#datatable").dataTable();


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


//MOSTRAR DATOS EN EL MODAL
function abrimodal(id){

    if(id == "0"){

        limpiarcajasunidas();

        $("#guardar").show();
        $("#actualizar").hide();

      }else{

        $("#guardar").hide();
        $("#actualizar").show();

        $.get(urlgeeneral+"/matenimineto-categorias/editar/"+id, function (data) {
            //console.log(data["Codigo"]);
            $("#valor").val(id);
            document.getElementById("categoria").value = data["name"];
            $("#slug").val(data["slug"]);
            selector( data["area_id"]);


        });



      }
}


//GUARDAR LOS DATOS DE SECTOR
$("#guardar").on("click",function(){

    if (datosobligatorio() == true) {

      var frm = new FormData();
      var csrf = document.querySelector('meta[name="csrf-token"]').content;
      var name=$("#categoria").val();
      var selectid_area = document.getElementById("id_area"); /*Obtener el SELECT */
      var id_area = selectid_area.options[selectid_area.selectedIndex].value;
      var slug=$("#slug").val();

      frm.append("name", name);
      frm.append("area_id", id_area);
      frm.append("slug",slug);
      frm.append("_token", csrf);

      $.ajax({
        type: "POST",
        url: urlgeeneral+"/matenimineto-categorias/crear",
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

                listarareas();
                $('#staticBackdrop').modal('hide');


           }
      });


    }
});


//METODO PARA ACTUALIZAR DATOS

//MODIFICAR LOS SECTORES
$("#actualizar").on("click",function(){

    if (datosobligatorio() == true) {

              var frm = new FormData();
              var csrf = document.querySelector('meta[name="csrf-token"]').content;
              var name=$("#categoria").val();
              var selectid_area = document.getElementById("id_area"); /*Obtener el SELECT */
              var id_area = selectid_area.options[selectid_area.selectedIndex].value;
              var slug=$("#slug").val();

              var id=$("#valor").val();

              frm.append("id", id);
              frm.append("name", name);
              frm.append("area_id", id_area);
              frm.append("slug", slug);
              frm.append("_token", csrf);

              $.ajax({
                type: "POST",
                url: urlgeeneral+"/matenimineto-categorias/editar",
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

                  listarareas();
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
                  title: '¿Desea Anular la Categoria?',
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
                      url: urlgeeneral+"/matenimineto-categorias/eliminar/"+id,
                      data: {"_method": "delete",'_token': csrf},

                      success: function (data) {

                        listarareas();

                        Swal.fire(
                          'Eliminado!',
                          'El servicio ha sido eliminado.',
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
