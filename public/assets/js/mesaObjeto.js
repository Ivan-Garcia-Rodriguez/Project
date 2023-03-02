function MesaObjeto(id,x,y,width,height,pos){
    this.id=id;
    this.x=x;
    this.y=y;
    this.width=width;
    this.height=height;
    this.pos=pos;

}

// MesaObjeto.prototype.choque=function(mesaObjeto2){
//   var choque = false;

//   console.log(this);
  
//   debugger;
//   console.log(this.pos[0])
 
//     if((this.pos[0]>mesaObjeto2.pos[0] && this.pos[0]<mesaObjeto2.pos[1] || this.pos[1]>mesaObjeto2.pos[0] && this.pos[1]<mesaObjeto2.pos[1] || this.pos[0]<=mesaObjeto2.pos[0] && this.pos[1]>=mesaObjeto2.pos[1]) 
//             &&
//               (this.pos[2]>mesaObjeto2.pos[2] && this.pos[2]<mesaObjeto2.pos[3] || this.pos[3]>mesaObjeto2.pos[2] && this.pos[3]<mesaObjeto2.pos[3] || this.pos[2]<=mesaObjeto2.pos[2] && this.pos[3]>=mesaObjeto2.pos[3])){
//             choque=true;
           
//             }

//     return choque;
// }

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