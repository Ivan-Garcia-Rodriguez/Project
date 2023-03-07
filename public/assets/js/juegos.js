$(function(){


    $(".dialog").hide();
    
          //Conseguimos todos los juegos de la base de datos
            $.ajax({
                type:'GET',
                url: "http://localhost:8000/api/juego/todos",
                dataType: "json"
            }).success(function(data){

              //PARA QUE SALGA EN EL BODY
              var row = $("<div>").attr("class","row");
              row.appendTo($('.heading-section'));
              var contador = 0;

                //POR CADA OBJETO QUE HALLA EN LA BASE DE DATOS
                $.each(data["juegos"],function(){
                  
                  //CREAMOS LAS ETIQUETAS HTML 
                    var idJuego=data["juegos"][contador]["id"];   
                    var responsi = $("<div>").attr("class", "col-lg-3 col-sm-6");
                    var item = $("<div>").attr("class","item");
                    $(item).attr("idJuego",idJuego);
                    var imagen = $("<img>").attr("src","/assets/images/"+data["juegos"][contador]["imagen"]).css({height: "180px"});
                    var h4 = $("<h4>").text(data["juegos"][contador]['Nombre']);
                    var br= $("<br>");
                    var span = $("<span>").text(data["juegos"][contador]['editorial']);
                    var ul = $("<ul>");
                    var li = $("<li>").text(data["juegos"][contador]['minimo'] +" - "+data["juegos"][contador]['maximo']);
                    var i = $("<i>").attr("class","fa fa-user");

                   //Y LAS PINTAMOS
                    responsi.appendTo($(row));
                    item.appendTo($(responsi));
                    imagen.appendTo($(item));
                    h4.appendTo($(item));
                    br.appendTo($(h4));
                    span.appendTo($(h4));
                    ul.appendTo($(item));
                    li.appendTo($(ul));
                    i.appendTo($(li));
                    contador++;

                    //POR CADA TARJETA NOS MOSTRARÁ UN DIALOG QUE NOS PERMITE BORRAR EL JUEGO
                    $(".item").click(function(){
                            $(".dialog").dialog({

                              autoOpen:true,
                              show: {
                                effect: "blind",
                                duration: 500
                              },
                              hide:{
                                effect: "explode",
                                duration: 500
                              }
                            })
                            //BORRAMOS LA MESA DE LA BASE DE DATOS CON LA ID DEL JUEGO CONCRETO
                            $(".borrar").click(function(){
                              $.ajax({
                                type: "DELETE",
                                url: "http://localhost:8000/api/juego/borrar/"+idJuego, 
                                                
                              }).success(function(data){
                                $(".dialog").dialog("close");
                                location.reload();
                              })
                              
                            })
                    })
                })
            
                
            




        })
        
    
})