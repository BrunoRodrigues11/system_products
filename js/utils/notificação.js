$(document).ready(function () {
    var alerta = $("#alert");

    setTimeout(function () {
        alerta.hide();
    }, 5000);
    
    $(".btn-close").click(function(){
        alerta.hide();     
      });
});
