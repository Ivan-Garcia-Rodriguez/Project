$(function(){
    var cancionFondo = document.getElementById("cancionFondo");

    //ARRAY CON EL NOMBRE DE LAS CANCIONES
    let playList = 
    [
      'wiiShop.mp3',
      'kecleonShop.mp3',
      'miiChannel.mp3',
      'wiiSports.mp3',
      'wiiResults.mp3',
      'CentroCocotero.mp3',
      'GatoConBotas.mp3',
      'paseo.mp3'
    ]

    let tope =7;
    let trackIndex;

    trackIndex = 0;

    var siguiente = document.getElementById("siguiente");
    var anterior = document.getElementById("anterior");

    //BUSCA EN LA ARRAY LA CANCION Y LA REPRODUCE
    function cambiaCancion(numCancion){
      cancionFondo.src= 'audio/' + playList[numCancion];
      cancionFondo.currentTime = 0;
      cancionFondo.play();
    }


    //EN CASO DE QUE NO EXISTA LA CANCION DE FONDO
    if(cancionFondo==null || cancionFondo==undefined){

    //SI NO
    }else{



      
      audioPlay = setInterval(function(){
        let tiempoCancion = Math.round(cancionFondo.currentTime);
        let cancionLength = Math.round(cancionFondo.duration);
  
        //CUANDO ACABA, SE REPRODUCE LA SIGUIENTE CANCION
        if(tiempoCancion == cancionLength && trackIndex <tope ){
          trackIndex++;
          cambiaCancion(trackIndex);
        } else if (tiempoCancion == cancionLength && trackIndex >=tope){
          trackIndex = 0;
          cambiaCancion(trackIndex);
        }
      },10)
    }

// SI NO EXISTE EL BOTON ANTERIOR
if(anterior == null || anterior  == undefined){

}
//BUSCA EN LA ARRAY EL ANTERIOR O LA ULTIMA CANCION Y LA REPRODUCE
else{
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
    
//SI NO EXISTE EL BOTON SIGUIENTE
if(siguiente == null || siguiente ==undefined ){

}
//BUSCA EN LA ARRAY LA SIGUIENTE O LA PRIMERA CANCION Y LA REPRODUCE
else{
  
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

  //Cuando se refresca la página o se cambia, guardamos la posición de la canción en el local storage
    $(window).on('beforeunload',function(){
      localStorage.setItem('cancion',cancionFondo.currentTime);
      
    })
    cancionFondo.currentTime= localStorage.getItem('cancion');
    
    var silenciar = document.getElementById("silenciar");
    var contenedorSilenciar = document.getElementById("contenedorSilenciar");

    //EVENTO QUE MUTEA LA CANCIÓN SI ESTÁ SONANDO Y DESMUTEA SI NO LO ESTÁ
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
    