urlgeeneral=$("#url_raiz_proyecto").val();
$("#actualizar").hide();



window.addEventListener("load", function (event) {

    //listarinfo();
    $(".loader").fadeOut("slow");
    listar();
    let codigo=0;
    alamcenes(codigo);
    //productos();


  });

  function listar(){

    $.get(urlgeeneral+"/conteo/listado",function(data){


          let contenido="";
          for (var i = 0; i < data.length; i++) {
              contenido += "<tr>";

              contenido += "<td style='padding:1px;text-align:center'>" + data[i].almacen  + "</td>";
              contenido += "<td style='padding:1px;text-align:center'>" + data[i].hora + "</td>";
              contenido += "<td style='padding:1px;text-align:center'>" + data[i].fecha + "</td>";
              contenido += "<td style='padding:1px;text-align:center'>" + data[i].contador + "</td>";
              contenido += "<td style='padding:1px;text-align:center'>" + data[i].hora_fin + "</td>";
              contenido += "<td style='padding:1px;text-align:center'>" + data[i].fecha_fin + "</td>";
              contenido += "<td style='padding:1px;text-align:center'>" + data[i].estado + "</td>";
              contenido += "<td style='padding:1px;text-align:center'>";
            //contenido +='<i class="fas fa-edit"></i>';
            contenido +=' <button type="button" onclick="abrimodal(\''+ data[i].id +'\')" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bx bx-pencil label-icon"></i></button>';
            contenido +='<button type="button" onclick="eliminarsector(\''+ data[i].id+'\')" class="btn btn-danger  eliminar"><i class="bx bxs-trash label-icon"></i></button>';
               contenido +="</td>";


              contenido += "</tr>";


          }


        document.getElementById("conteo").innerHTML = contenido;
       $("#dataTableExample").dataTable();



    });
}


  function abrimodal(id){

   // alert(id);



    if(id == "0"){

      //limpiarcajasunidas();

      $("#guardar").show();
      $("#actualizar").hide();

    }else{

        $("#guardar").hide();
        $("#actualizar").show();

        $.get(urlgeeneral+"/conteo/editar/" + id, function (data) {
          //console.log(data["Codigo"]);
          $("#valor").val(id);
          alamcenes(data.id_almacen);
          console.log(data);
          //ocument.getElementById("sector").value = data["name"];


      });


    }


}

function alamcenes(codigo){

    $.get(urlgeeneral+"/conteo/almacenes",function(data){



        console.log( codigo);

        contenido="";
        contenido +='<option value="">--Seleccionar--</option>';

        for (let index = 0; index < data.length; index++) {



            if(codigo==data[index].id){


                contenido += "<option value='" + data[index].id + "' selected>" + data[index].almacen + "</option >";

            }else{



                contenido += "<option value='" + data[index].id + "' >" + data[index].almacen + "</option >";

               // console.log( data[index].almacen );

            }




        }

        document.getElementById("id_almacen_des").innerHTML=contenido;


    });


}



//ABRIL EL MODAL

$("#guardar").on("click",function(){

    //if (datosobligatorio() == true) {
        let codigx=0;

      var frm = new FormData();
      var csrf = document.querySelector('meta[name="csrf-token"]').content;

      var selectid_almacen = document.getElementById("id_almacen_des"); /*Obtener el SELECT */
      var id_almacen = selectid_almacen.options[selectid_almacen.selectedIndex].value;




      //var name=$("#sector").val();

      frm.append("id_almacen", id_almacen);
      frm.append("_token", csrf);

                    $.ajax({
                        type: "POST",
                        url: urlgeeneral+"/conteo/crear",
                        data: frm,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function (data) {

                            console.log(data);


                        Swal.fire({
                            icon: 'success',
                            title: 'Oops...',
                            text: 'Conteo Creado Correctamente',
                            footer: ''
                        })

                            //listarbeneficiario();
                            listar();
                            $('#staticBackdrop').modal('hide');


                        }
                    });


    //}
});

//FUNCION PARA LLAMAR EL CONTEO

//FINALIZAR REGISTRO

$("#actualizar").on("click",function(){

    //if (datosobligatorio() == true) {

              var frm = new FormData();
              var csrf = document.querySelector('meta[name="csrf-token"]').content;

              var selectid_almacen = document.getElementById("id_almacen_des"); /*Obtener el SELECT */
              var id_almacen = selectid_almacen.options[selectid_almacen.selectedIndex].value;
              var id=$("#valor").val();

              //alert(id+"  "+id_almacen);

              frm.append("id_almacen", id_almacen);
              frm.append("id", id);
              frm.append("_token", csrf);

              $.ajax({
                type: "POST",
                url: urlgeeneral+"/conteo/modificar",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: frm,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (data) {

                    console.log(data);


                  Swal.fire({
                    icon: 'success',
                    title: 'Oops...',
                    text: 'Conteo cerrado correctamente',
                    footer: ''
                  })

                  listar();
                  $('#staticBackdrop').modal('hide');
                  //console.log(data);

                  }
              });


    //}

  });


