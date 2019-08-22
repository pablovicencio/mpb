//gif cargando
$(document).ajaxStart(function() {
  $("#upd").hide();
  $("#loading").show();
     }).ajaxStop(function() {
  $("#loading").hide();
  $("#upd").show();
  }); 

//cambio nom
$(document).ready(function() {
  $("#nom_usu").change(function() {    
  	$("#btn_upd").css("display","block");
  });
});

//upd nom
$(document).ready(function() {
  $("#btn_upd").onClick(function() {  
     var nom = $("#nom_usu").val();
		  
  	 $.ajax({
      type: "POST",
      url: 'controles/controlUpdUsu.php',
      data:{"nom":nom},
      success: function (result) { 
        var msg = result.trim();

        switch(msg) {
                case '0':
                    swal("Error de datos", "Favor verifique los datos ingresados", "warning");
                    break;
                case '1':
                    swal("Error de Datos", "Los datos ingresados no son validos, favor reintente", "warning");
                    break;
                
                case '3':
                    swal("Error Base de Datos", "Error de base de datos, comuniquese con el administrador", "warning");
                    break;
                default:
                    swal("Contraseña Reestablecida", msg, "success");
                    setInterval('location.reload()',10000);
            }
      },
      error: function(){
              alert('Verifique los datos')      
      }
    });
    return false;
  });
});