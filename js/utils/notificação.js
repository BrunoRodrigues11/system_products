$(document).ready(function () {
    var alerta = $("#alert");

    setTimeout(function () {
        alerta.hide();
    }, 2500);
    
    $(".btn-close").click(function(){
        alerta.hide();     
      });
});
