function MesaObjeto(x,y,width,height,pos){
    this.x=x;
    this.y=y;
    this.width=width;
    this.height=height;
    this.pos=pos;

}

MesaObjeto.prototype.choque=function(mesaObjeto2){
  var choque = false;

 
    if((this.pos[0]>mesaObjeto2.pos[0] && this.pos[0]<mesaObjeto2.pos[1] || this.pos[1]>mesaObjeto2.pos[0] && this.pos[1]<mesaObjeto2.pos[1] || this.pos[0]<=mesaObjeto2.pos[0] && this.pos[1]>=mesaObjeto2.pos[1]) 
            &&
              (this.pos[2]>mesaObjeto2.pos[2] && this.pos[2]<mesaObjeto2.pos[3] || this.pos[3]>mesaObjeto2.pos[2] && this.pos[3]<mesaObjeto2.pos[3] || this.pos[2]<=mesaObjeto2.pos[2] && this.pos[3]>=mesaObjeto2.pos[3])){
            choque=true;
           
            }

    return choque;
}

MesaObjeto.prototype.pinta=function(){

   var divMesa = $("<div>");
   divMesa.width(this.width);
   divMesa.height(this.height);
   divMesa.css('backgroundColor','brown');
   divMesa.attr('class','mesa');
   $(".almacen").append(divMesa); 
   divMesa.draggable({
    revert: true,
      helper: 'clone',
      revertDuration:0,
      start:function(ev,ui){
        $(this).attr("data-y",ui.offset.top)
        $(this).attr("data-x",ui.offset.left)

        
   }})
}