$(function(){

  $(".dialog").hide();
  $(".boton").click(
    function(){
      
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

      $(".cerrar").click(function(){
        $(".dialog").dialog("close");
      })
      
    $(".crear").click(function(){
      var ancho = $(".ancho").val();
      var alto = $(".alto").val();
      

      
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
          
          
          var mesaNueva = new MesaObjeto(data['id'],null,null,ancho,alto,null);
          mesaNueva.pinta();
          
           $(".dialog").dialog("close")
        
      })
      
    })

     
    
     
    }
 
)

    // $(".mesa").draggable({
    //   revert: true,
    //   helper: 'clone',
    //   revertDuration:0,
    //   start:function(ev,ui){
    //     $(this).attr("data-y",ui.offset.top)
    //     $(this).attr("data-x",ui.offset.left)
       
      
        

    //   }});

  
      

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
        

        var mesaObjeto = new MesaObjeto(klk,x,y,width,height,pos1);
        console.log(mesaObjeto);
        debugger;
   
         
        let valido=true;
        var mesaYa=$(".sala .mesa");
        $.each(mesaYa,function(key,value){

          if(value !=mesaObjeto && !$(value).hasClass('ui-draggable-dragging')){
            var id = $(value).attr('idMesa');
            posX=parseInt(value.offsetLeft);
            posY=parseInt(value.offsetTop);
            var anchura=(value.offsetWidth);
            var altura=(value.offsetTop);
            
           
            var pos2=[posX,posX+anchura,posY,posY+altura];
            
            var mesaNueva= new MesaObjeto(id,posX,posY,anchura,altura,pos2);
            // if(mesaObjeto.choque(mesaNueva)==true){
            //   valido=false;
            //   posX=parseInt(value.offsetLeft);
            //   posY=parseInt(value.offsetTop);
            //   var anchura=(value.offsetWidth);
            //   var altura=(value.offsetTop);
             
            //   var pos2=[posX,posX+anchura,posY,posY+altura];
              
            //   var mesaNueva= new MesaObjeto(posX,posY,anchura,altura,pos2);               
            // }
          }
          
         
          
            
            
          
        })
        
        if(valido){
          
          
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

      console.log(mesasTotales);
      debugger;
      $.ajax({
        type: "POST",
        url:"http://localhost:8000/api/disposicion",
        dataType: 'json',
        data: {
          mesasTotales : mesasTotales
        }

        

      })

      

    })
   

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





    









    
    var cancionFondo = document.getElementById("cancionFondo");


    let playList = 
    [
      'wiiShop.mp3',
      'kecleonShop.mp3',
      'miiChannel.mp3',
      'wiiSports.mp3',
      'wiiResults.mp3',
      'CentroCocotero.mp3'
    ]

    let tope =5;
    let trackIndex;

    trackIndex = 0;

    var siguiente = document.getElementById("siguiente");
    var anterior = document.getElementById("anterior");

    function cambiaCancion(numCancion){
      cancionFondo.src= 'audio/' + playList[numCancion];
      cancionFondo.currentTime = 0;
      cancionFondo.play();
    }


    
    if(cancionFondo==null || cancionFondo==undefined){

    }else{



      
      audioPlay = setInterval(function(){
        let tiempoCancion = Math.round(cancionFondo.currentTime);
        let cancionLength = Math.round(cancionFondo.duration);
  
        if(tiempoCancion == cancionLength && trackIndex <tope ){
          trackIndex++;
          cambiaCancion(trackIndex);
        } else if (tiempoCancion == cancionLength && trackIndex >=tope){
          trackIndex = 0;
          cambiaCancion(trackIndex);
        }
      },10)
    }


if(anterior == null || anterior  == undefined){

}else{
  anterior.addEventListener("click",function(){
    if(trackIndex >0){
      trackIndex--;
      cambiaCancion(trackIndex);
    }else{
      trackIndex=tope;
      cambiaCancion(trackIndex);
    }
  })
}
    
if(siguiente == null || siguiente ==undefined ){

}else{
  
  siguiente.addEventListener("click",function(){
    if(trackIndex < tope){
      trackIndex++;
      cambiaCancion(trackIndex);
    }
    else{
      trackIndex=0;
      cambiaCancion(trackIndex);
    }
  })
}


    $(window).on('beforeunload',function(){
      localStorage.setItem('cancion',cancionFondo.currentTime);
      
    })
    cancionFondo.currentTime= localStorage.getItem('cancion');
    
    var silenciar = document.getElementById("silenciar");
    var contenedorSilenciar = document.getElementById("contenedorSilenciar");

    
    $(contenedorSilenciar).click(function(ev){
        
      if(cancionFondo.muted===false){
        cancionFondo.muted=true;
        silenciar.innerHTML="desilenciar";  

    }
    else{
        silenciar.innerHTML='silenciar';
        cancionFondo.muted=false;
    }

    })

    
      
      
      
    
})