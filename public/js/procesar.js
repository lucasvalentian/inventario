urlgeeneral=$("#url_raiz_proyecto").val();
$("#actualizar").hide();


window.addEventListener("load", function (event) {

    //listarinfo();
    $(".loader").fadeOut("slow");
    //listar();
    let codigo=0;
    alamcenes(codigo);
    //productos();


  });










function alamcenes(codigo){

    $.get(urlgeeneral+"/conteo/almacenes",function(data){



        //console.log( codigo);

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

function seleccionar_conteo(id){

    alert(id); $.get(urlgeeneral+"/resumen/conteo/"+id,function(data){

        contenido="";
        contenido +='<option value="">--Seleccionar--</option>';
        for (let index = 0; index < data.length; index++) {

                contenido += "<option value='" + data[index].id + "' >" + data[index].contador + "</option >";
               // console.log( data[index].almacen );
        }

        document.getElementById("conteo_uno").innerHTML=contenido;




    });
}

//METODO PARA CAGAR LOS CONTEOS POR ALMACEN
function conteoalmacen(){






}
