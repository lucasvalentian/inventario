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

    //alert(id);
    $.get(urlgeeneral+"/resumen/conteo/"+id,function(data){

        contenido="";
        contenido +='<option value="">--Seleccionar--</option>';
        for (let index = 0; index < data.length; index++) {

                contenido += "<option value='" + data[index].contador + "' >" + data[index].contador + "</option >";
               // console.log( data[index].almacen );
        }

        document.getElementById("conteo_uno").innerHTML=contenido;
        document.getElementById("conteo_dos").innerHTML=contenido;




    });
}

//METODO PARA CAGAR LOS CONTEOS POR ALMACEN
function conteoalmacen(){






}

//metodo para enviar la data

function procesar()
{
    var selectid_id_almacen_des= document.getElementById("id_almacen_des"); /*Obtener el SELECT */
    var id_almacen_des = selectid_id_almacen_des.options[selectid_id_almacen_des.selectedIndex].value;

    var selectid_conteo_uno= document.getElementById("conteo_uno"); /*Obtener el SELECT */
    var conteo_uno = selectid_conteo_uno.options[selectid_conteo_uno.selectedIndex].value;

    var selectid_conteo_dos= document.getElementById("conteo_dos"); /*Obtener el SELECT */
    var conteo_dos = selectid_conteo_dos.options[selectid_conteo_dos.selectedIndex].value;

    //alert(id_almacen_des+" "+conteo_uno+" "+conteo_dos);

    $.get(urlgeeneral+"/resumen/procesar/"+id_almacen_des+"/"+conteo_uno+"/"+conteo_dos,function(data){

        $("#staticBackdrop").modal("show");
        console.log(data);

        if(data=='OK'){

            $('#staticBackdrop').css('display','none');
            $(".modal-backdrop").removeClass("show");
            $(".fade").removeClass("modal-backdrop");


        }


    });


}
