$(function(){


    $(".dialog").hide();
    $(".item").click(function(){
        $.each($(".item"),function(){
            $.ajax({
                type:'GET',
                url: "http://localhost:8000/api/juegos",
                dataType: "json"
            }).success(function(data){
                $.each(data,function(){
                    var row = $("<div>").attr("class","row");
                    var responsi = $("<div>").attr("class", "col-lg-3 col-sm-6");
                    var item = $("<div>").attr("class","item");
                    var imagen = $("<img>").attr("src","/assets/images/"+data['imagen']).css({height: "130px"});
                    var h4 = $("<h4>").text(data['nombre']);
                    var br= $("<br>");
                    var span = $("<span>").text(data['editorial']);
                    var ul = $("<ul>");
                    var li = $("<li>").text(data['minimo'] +" - "+data['maximo']);
                    var i = $("<i>").attr("class","fa fa-user");



                })
            })
                
            




        })
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
    })
})