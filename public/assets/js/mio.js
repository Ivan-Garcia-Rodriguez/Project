$(function(){

  $(".dialog").hide();
  $(".boton").click(
    function(){
      
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

      $(".cerrar").click(function(){
        $(".dialog").dialog("close");
      })
      
    $(".crear").click(function(){
      var ancho = $(".ancho").val();
      var alto = $(".alto").val();
      var mesaNueva = new MesaObjeto(40,50,ancho,alto,null);

      
      $.ajax({
        type: "POST",
        url:"http://localhost:8000/api/mesa/nueva",
        dataType: 'json',
        data: {
          ancho : ancho,
          alto: alto,
          x: 40,
          y:50,
        }

      }).success(function (data){
        console.log(data);
       
          mesaNueva.pinta();

           $(".dialog").dialog("close")
        
      })
      
    })

     
    
     
    }
 
)

    $(".mesa").draggable({
      revert: true,
      helper: 'clone',
      revertDuration:0,
      start:function(ev,ui){
        $(this).attr("data-y",ui.offset.top)
        $(this).attr("data-x",ui.offset.left)

        

      }});

  
      

    $(".sala").droppable({
      drop : function(event,ui){
        var mesa= ui.draggable;

        var x= parseInt(ui.offset.left)
          var y= parseInt(ui.offset.top)
           var width= parseInt(mesa.width())
           var height= parseInt(mesa.height())
        var pos1= [x,x+width,y,y+height]

        var mesaObjeto = new MesaObjeto(x,y,width,height,pos1);
        
        let valido=true;
        var mesaYa=$(".sala .mesa");
        $.each(mesaYa,function(key,value){

          if(value !=mesaObjeto && !$(value).hasClass('ui-draggable-dragging')){
            posX=parseInt(value.offsetLeft);
            posY=parseInt(value.offsetTop);
            var anchura=(value.offsetWidth);
            var altura=(value.offsetTop);
           
            var pos2=[posX,posX+anchura,posY,posY+altura];
            
            var mesaNueva= new MesaObjeto(posX,posY,anchura,altura,pos2);
            if(mesaObjeto.choque(mesaNueva)==true){
              valido=false;
                              
            }
          }
          
         
          
            
            
          
        })
        
        if(valido){
          $(this).append(mesa)

         
         mesa.css({position:"absolute",top: y+"px",left: x+"px"})
        }
       
      

      
      }
    });

    $(".almacen").droppable({
      drop:function(ev,ui){
        var mesa = ui.draggable;   
        mesa.css({position:"relative",top: 0+"px",left: 0+"px"})   
        $(this).append(mesa)
       
      }
    })



    
      
      
      
    
})