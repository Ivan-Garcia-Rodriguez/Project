$(function(){

  $(".dialog").hide();
  $(".boton").click(
    function(){
      
      //Las animaciones del dialog
      $(".dialog").dialog({
        
      
        width: 800,
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

      //Para cerrar el dialog
      $(".cerrar").click(function(){
        $(".dialog").dialog("close");
      })
      
      //Para crear la mesa
    $(".crear").click(function(){
      var ancho = $(".ancho").val();
      var alto = $(".alto").val();
      

      //MANDAMOS LOS DATOS Y CREAMOS LA MESA EN LA BASE DE DATOS
      $.ajax({
        type: "POST",
        url:"http://localhost:8000/api/mesa",
        dataType: 'json',
        data: {
          ancho : ancho,
          alto: alto,
          x: null,
          y: null,
        }

      }).success(function (data){
          console.log(data['id']);
          
          //CREAMOS LA MESA, LA PINTAMOS Y CERRAMOS EL DIALOG 
          var mesaNueva = new MesaObjeto(data['id'],null,null,ancho,alto,null);
          mesaNueva.pinta();
          
           $(".dialog").dialog("close")
        
      })
      
    })

     
    
     
    }
 
)

   

  
      

    $(".sala").droppable({
      drop : function(event,ui){
        
        
        var mesa= ui.helper;
        
    
        var klk = $(mesa).attr('idMesa');
        console.log(klk);
     
        var x= parseInt(ui.offset.left)
        var y= parseInt(ui.offset.top)
        var width= parseInt(mesa.width())
        var height= parseInt(mesa.height())
        var pos1= [x,x+width,y,y+height]
        
        //CREAMOS EL OBJETO MESAOBJETO CON TODOS LOS DATOS DE LA MESA
        var mesaObjeto = new MesaObjeto(klk,x,y,width,height,pos1);
        
   
         
        let valido=true;
        var mesaYa=$(".sala .mesa");
        //POR CADA MESA QUE ESTÉ EN LA SALA COMPROBAMOS QUE NO CHOQUEN
        $.each(mesaYa,function(key,value){

          if(value !=mesaObjeto && !$(value).hasClass('ui-draggable-dragging')){
            var id = $(value).attr('idMesa');
            posX=parseInt(value.offsetLeft);
            posY=parseInt(value.offsetTop);
            var anchura=(value.offsetWidth);
            var altura=(value.offsetTop);
            
           
            var pos2=[posX,posX+anchura,posY,posY+altura];
            //LA MESA QUE QUEREMOS COMPROBAR QUE NO CHOQUEN
            var mesaNueva= new MesaObjeto(id,posX,posY,anchura,altura,pos2);
            if(mesaObjeto.choque(mesaNueva)==true){
              valido=false;
              posX=parseInt(value.offsetLeft);
              posY=parseInt(value.offsetTop);
              var anchura=(value.offsetWidth);
              var altura=(value.offsetTop);
             
              var pos2=[posX,posX+anchura,posY,posY+altura];
              
              var mesaNueva= new MesaObjeto(posX,posY,anchura,altura,pos2);               
            }
          }
          
         
          
            
            
          
        })
        
        //SI NO CHOCA
        if(valido){
          
          //Cada vez que movemos la mesa, se actualiza su valor en la base de datos y la dropeamos en
          // la sala
          $.ajax({
            type: "PUT",
            url:"http://localhost:8000/api/mesa/"+mesaObjeto.id,
            dataType: 'json',
            data: {
              ancho : mesaObjeto.width,
              alto: mesaObjeto.height,
              x: mesaObjeto.x,
              y: mesaObjeto.y,
            }
    
          })


         var mesa= ui.draggable;
         
          mesa.css({position:"absolute",top: mesaObjeto.y,left: mesaObjeto.x})
          $(mesa).attr('idMesa',mesaObjeto.id)
          $(this).append(mesa)
          
        
         
       
        }
       
      

        
      }
    });


    //Por cada mesa que esté en la sala las guardamos en una array de Mesas
    $(".botonGuardar").click(function(){
      
      
      var mesaYa=$(".sala .mesa");
      var mesasTotales=[];
      $.each(mesaYa,function(key,value){
           var id = $(value).attr('idMesa');
           posX=parseInt(value.offsetLeft);
           posY=parseInt(value.offsetTop);
           var anchura=(value.offsetWidth);
           var altura=(value.offsetTop);  
           var pos2=[posX,posX+anchura,posY,posY+altura];
           var mesaNueva= new MesaObjeto(id,posX,posY,anchura,altura,pos2);
           mesasTotales.push(mesaNueva);   
      })


      //Guardamos la disposición en la BD
      $.ajax({
        type: "POST",
        url:"http://localhost:8000/api/disposicion",
        dataType: 'json',
        data: {
          mesasTotales : mesasTotales
        }

        

      })

      

    })
   
    //Le ponemos a la mesa una posición, un left de 0 y un top de 0, le añadimos el id de la BD y
    // la enlacamos
    $(".almacen").droppable({
      drop:function(ev,ui){
        var mesa= ui.helper;
        
    
        var klk = $(mesa).attr('idMesa');
        console.log(klk);
     
        var x= parseInt(ui.offset.left)
        var y= parseInt(ui.offset.top)
        var width= parseInt(mesa.width())
        var height= parseInt(mesa.height())
        var pos1= [x,x+width,y,y+height]
        

        var mesaObjeto = new MesaObjeto(klk,x,y,width,height,pos1);
        var mesa = ui.draggable;   
        $(mesa).css({position:"relative",top: 0+"px",left: 0+"px"})   
        $(mesa).attr('idMesa',mesaObjeto.id)
        $(this).append(mesa)
       
      }
    })





    











    
      
      
      
    
})