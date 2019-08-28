
      try{ 
              var lista_compra = Cookies.get('lista_compra');
              var lista = [lista_compra];

          }
      catch(e){ 
              //console.log(e);
              var lista = [];
          }


//funcion modal listas guardadas
  function lista_guardada(id) {

    $("#tbody_modalprod").empty();



      $.ajax({
      url: '../controles/controlListaGuarda.php',
      type: 'POST',
      data: {"lista":id},
      dataType:'json',
      success:function(result){
         
//console.log(result);

                  var filas = Object.keys(result).length;
                    //console.log (filas);
                 
                    for (  i = 0 ; i < filas; i++){ //cuenta la cantidad de registros
                      var nuevafila= '<tr><td style="display:none;">' +
                      result[i].id_prod + "</td><td>" +
                      result[i].nom_tienda + "</td><td>" +
                      result[i].nom_prod + "</td><td>" +
                      result[i].cant + "</td><td>" +
                      result[i].precio + "</td><td>" +
                      // numeral(result[i].cant_docs).format('000,000,000,000') + "</td><td>" +
                      // numeral(result[i].cant_docs_ing).format('000,000,000,000') + "</td><td>" +
                      // numeral(result[i].cant_docs_pagop).format('000,000,000,000') + "</td><td>" +
                      // numeral(result[i].cant_docs_pagoc).format('000,000,000,000') + "</td><td>" +
                      // numeral(result[i].cargos).format('$000,000,000,000') + "</td><td>" +
                      // numeral(result[i].pagos).format('$000,000,000,000') + "</td><td>" +
                      // numeral(result[i].saldo).format('$000,000,000,000') + "</td><td>" +
                      // numeral(result[i].prom_dias_pago).format('000,000,000,000') + "</td><td>" +
                      '<a class="link-modal btn btn-outline-danger" onClick="eliminar('+result[i].id_prod+',\''+result[i].nom_prod+'\')"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>'
                      $("#tabla_prod").append(nuevafila);

                    }

                
              },
              error: function(){
                      alert('Verifique los datos')      
              }
        })

    
    

  }





//gif cargando
$(document).ajaxStart(function() {
  $("#upd").hide();
  $("#loading").show();
     }).ajaxStop(function() {
  $("#loading").hide();
  $("#upd").show();
  }); 

//cambio nom
$(document).ready(function(){
$("#nom_usu").keyup(function() {
  	$("#btn-upd").css("display","block");
});
});

//upd nom
$(document).on("click", "#btn_upd", function () {
 
     var nom = $("#nom_usu").val();
		  
  	 $.ajax({
      type: "POST",
      url: '../controles/controlUpdUsu.php',
      data:{"nom":nom},
      success: function (result) { 
        var msg = result.trim();

        switch(msg) {
                case '-1':
                    swal("Error Base de Datos", "Error de base de datos, comuniquese con el administrador", "warning");
                    break;
                default:
                    $("#nom_usu").val(nom);
                    swal("Usuario Modificado", msg, "success");

            }
      },
      error: function(){
              alert('Verifique los datos')      
      }
    });
    return false;

});


  function modalListaProd() {

    $("#tbody_modalprod").empty();

    fLen = lista.length;



    if (parseInt(fLen) <= 0) {
      swal("Agrega productos a tu lista", {
                        icon: "warning",
                      }); 
      //$("#modalProd").hide();
      //$.magnificPopup.close()



    }else{

      $.ajax({
      url: '../controles/controlListaProd.php',
      type: 'POST',
      data: {"lista":lista},
      dataType:'json',
      success:function(result){
         
//console.log(result);

                  var filas = Object.keys(result).length;
                    //console.log (filas);
                 
                    for (  i = 0 ; i < filas; i++){ //cuenta la cantidad de registros
                      var nuevafila= '<tr><td>' +
                      result[i].nom_tienda + "</td><td>" +
                      result[i].nom_prod + "</td><td>" +
                      result[i].cant + "</td><td>" +
                      result[i].precio + "</td><td>" +
                      // numeral(result[i].cant_docs).format('000,000,000,000') + "</td><td>" +
                      // numeral(result[i].cant_docs_ing).format('000,000,000,000') + "</td><td>" +
                      // numeral(result[i].cant_docs_pagop).format('000,000,000,000') + "</td><td>" +
                      // numeral(result[i].cant_docs_pagoc).format('000,000,000,000') + "</td><td>" +
                      // numeral(result[i].cargos).format('$000,000,000,000') + "</td><td>" +
                      // numeral(result[i].pagos).format('$000,000,000,000') + "</td><td>" +
                      // numeral(result[i].saldo).format('$000,000,000,000') + "</td><td>" +
                      // numeral(result[i].prom_dias_pago).format('000,000,000,000') + "</td><td>" +
                      '<a class="link-modal btn btn-outline-danger" onClick="eliminar('+result[i].id_prod+',\''+result[i].nom_prod+'\')"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>'
                      $("#tabla_prod").append(nuevafila);

                    }

                
              },
              error: function(){
                      alert('Verifique los datos')      
              }
        })

    }  
    

  }


  function isMobile() {

          try{ 
              document.createEvent("TouchEvent"); 
              $("#menuMob").css("display", "block");
              $("#menuMobFoo").css("display", "block");
              $("#prod_carro").text(lista.length);
          }
          catch(e){ 
              $("#menuDesk").css("display", "block");
              $("#prod_carro").text(lista.length);
          }
      }


  function ubicar($ori){
        $("#lista_prox").empty();


      if ($ori == 1) {
            $.ajax({
              type: "POST",
              url: '../vista/vistaUbicar.php',
              data:{"lista":lista},
              dataType:'json',
              success: function (result) { 
                  //var myData = result.replace("[", "");
                  //var myData = myData.replace("]", "");
                  //console.log(result);

                  data(result);

                  //Obtenemos la posición del usuario y lo manejamos con la función initialize
                  if (navigator.geolocation) {
                      navigator.geolocation.getCurrentPosition(initialize, error, {
                      maximumAge: 60000,
                      timeout: 4000
                      });
                  } else {
                      error('Actualiza el navegador web para usar el API de localización');
                  }

              
              //document.getElementById("container").style.display = "none";
              $("#mail").css("visibility", "hidden");
              $("#map").css("display", "block");

              $("#volver").css("display", "inline");
              $("#modalProd").hide();
              $("#modalProd").css("display", "none");
              //window.scroll(0, 0);
                
        },
              error: function(){
                    swal("Agrega productos a tu lista", {
                        icon: "warning",
                      });     
              }
        });

      }else if ($ori == 2) {

        var TableData = new Array();
    
              $('#tabla_prod tr').each(function(row, tr){
                TableData[row]={
                  "prod" : $(tr).find('td:eq(0)').text()
                }


            }); 
            TableData.shift();  // first row will be empty - so remove
            TableData = JSON.stringify(TableData);

            $('#tbConvertToJSON').val('JSON array: \n\n' + TableData.replace(/},/g, "},\n"));



          $.ajax({
              type: "POST",
              url: '../vista/vistaUbicarGuardada.php',
              data:{"data" : TableData},
              dataType:'json',
              success: function (result) { 
                  //var myData = result.replace("[", "");
                  //var myData = myData.replace("]", "");
                  //console.log(result);

                   data(result);

                   if (navigator.geolocation) {
                       navigator.geolocation.getCurrentPosition(initialize, error, {
                       maximumAge: 60000,
                       timeout: 4000
                       });
                   } else {
                       error('Actualiza el navegador web para usar el API de localización');
                   }

              

               $("#micuenta").css("visibility", "hidden");
               $("#map").css("display", "block");

               $("#volver").css("display", "inline");
               $("#modalProd").hide();
               $("#modalProd").css("display", "none");

                
        },
              error: function(){
                    swal("Agrega productos a tu lista", {
                        icon: "warning",
                      });     
              }
        });
      }





}