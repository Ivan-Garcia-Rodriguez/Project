//El constructor del objeto MesaObjeto
/**
 * 
 * @param {*} id La id de la mesa en la bd
 * @param {*} x Tipo float El left
 * @param {*} y Tipo float El top
 * @param {*} width Tipo float El ancho
 * @param {*} height Tipo float El alto
 * @param {*} pos La posicion de la mesa que guarda si left y top
 */
function MesaObjeto(id,x,y,width,height,pos){
    this.id=id;
    this.x=x;
    this.y=y;
    this.width=width;
    this.height=height;
    this.pos=pos;

}


//Pasamos otra entidad de tipo MesaObjeto y comprobamos que sus posiciones no choquen en ningún momento
/**
 * 
 * @param {*} mesaObjeto2 La mesa con la que vamos a comprobar si colisiona
 * @returns Boolean (True en caso de que choquen o false en caso de que no).
 */
MesaObjeto.prototype.choque=function(mesaObjeto2){
  var choque = false;




    //Comprobamos que la primera mesa no choque con la segunda comparando sus posiciones
    if((this.pos[0]>mesaObjeto2.pos[0] && this.pos[0]<mesaObjeto2.pos[1] || this.pos[1]>mesaObjeto2.pos[0] && this.pos[1]<mesaObjeto2.pos[1] || this.pos[0]<=mesaObjeto2.pos[0] && this.pos[1]>=mesaObjeto2.pos[1]) 
            &&
              (this.pos[2]>mesaObjeto2.pos[2] && this.pos[2]<mesaObjeto2.pos[3] || this.pos[3]>mesaObjeto2.pos[2] && this.pos[3]<mesaObjeto2.pos[3] || this.pos[2]<=mesaObjeto2.pos[2] && this.pos[3]>=mesaObjeto2.pos[3])){
            choque=true;
           
            }

    return choque;
}


/**
 * Metodo que genera y muestra una mesa gráficamente, asignandole la id de la base de datos,transformandolas a
 * draggable y la dejamos en el almacen
 */
MesaObjeto.prototype.pinta=function(){

   var divMesa = $("<div>");
   divMesa.width(this.width);
   divMesa.height(this.height);
   divMesa.css('backgroundColor','brown');
   divMesa.attr('class','mesa');
   divMesa.attr('idMesa',this.id);
   $(".almacen").append(divMesa); 
   divMesa.draggable({
    revert: true,
      helper: 'clone',
      revertDuration:0,
      accept: '.almacen, .sala',
      start:function(ev,ui){
        $(this).attr("data-y",ui.offset.top)
        $(this).attr("data-x",ui.offset.left)
        $(this).attr("idMesa",this.id);

        
   }})
}