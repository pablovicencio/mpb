
      try{ 
              var lista_compra = Cookies.get('lista_compra');
              var lista = [lista_compra];

          }
      catch(e){ 
              //console.log(e);
              var lista = [];
          }

function ubicar(){
        $("#lista_prox").empty();
        $.ajax({
              type: "POST",
              url: 'vista/vistaUbicar.php',
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
              $("#formbuscar").css("visibility", "hidden");
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


}



function eliminar(id,prod){
    swal({
        title: "¿Estas Seguro?",
        text: "Eliminaras "+prod+" de tus lista de compras",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          fLen = lista.length;


              for (i = 0; i < fLen; i++) {
                  console.log(lista);
                   
                     if (id == lista[i][0]) {

                      lista.splice(i, 1);
                      fLen = lista.length;
                     }
              }

          swal("Producto eliminado de tu lista", {
            icon: "success",
          });
          modalListaProd()
        } 
      });

}



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
      url: 'controles/controlListaProd.php',
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




    
    function volver(){
            $("#formbuscar").css("visibility", "visible");
            $("#map").css("display", "none");

            $("#volver").css("display", "none");
            $("#producto").val("");
    }


    function agregar(id,prod) {
              swal({
              text: 'Ingresa la cantidad',
              content: "input",
              button: {
                text: "Agregar "+prod,
                closeModal: false,
              },
            })
            .then(cant => {
              if (!cant) throw null;

              existe = -1;

              fLen = lista.length;


              for (i = 0; i < fLen; i++) {
                   
                     if (id == lista[i][0]) {
                      existe = id;
                     }
              }

               
              

              if (existe < 0) {
                lista.push([id, parseInt(cant)]);

                
              
                Cookies.set('lista_compra',lista, { expires: 90 });

                swal("Producto Agregado", prod +" agregado", "success");

                
              }else if (existe >= 0) {



                lista.forEach(function(producto) {
                  
                  if(producto[0] == existe){
                    console.log("entra");
                    console.log(producto[1]);
                         producto[1] = parseInt(producto[1]) + parseInt(cant);
                    console.log(producto[1]);
                    swal("Producto Sumado", prod + " "+producto[1]+" en total", "success");
                       }
                  
                });
              }

              $("#prod_carro").text(lista.length);
             
            })
            .catch(err => {
              if (err) {
                swal("Oh no!", "El producto no se ha agregado "+err, "error");
              } else {
                swal.stopLoading();
                swal.close();
              }
            });
      }




    function isMobile() {

          try{ 
              document.createEvent("TouchEvent"); 
              $("#menuMob").css("display", "block");
              $("#menuMobFoo").css("display", "block");
          }
          catch(e){ 
              $("#menuDesk").css("display", "block");
          }
      }


        $(document).ajaxStart(function() {
          $("#formbuscar").hide();
          $("#loading").show();
             }).ajaxStop(function() {
          $("#loading").hide();
          $("#formbuscar").show();
          });  

  $(document).ready(function() {
          $("#formbuscar").submit(function() {
          $("#lista_prox").empty();    
            $.ajax({
              type: "POST",
              url: 'vista/vistaBuscar.php',
              data:$("#formbuscar").serialize(),
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
              $("#formbuscar").css("visibility", "hidden");
              $("#map").css("display", "block");

              $("#volver").css("display", "inline");
              //window.scroll(0, 0);
                
              },
              error: function(){
                      alert('Verifique los datos')      
              }
            });
            return false;
          });
        });    




     function modal(id) {
    
    document.getElementById("portafolio_titulo").innerHTML = "";
    document.getElementById("portafolio").innerHTML = "";
     $.ajax({
      url: 'controles/controlPortafolio.php',
      type: 'POST',
      data: {"id":id},
      success:function(result){
         
              document.getElementById("portafolio").innerHTML = result;
               switch(id){
                          case 1:
                            document.getElementById("portafolio_titulo").innerHTML = "Categoria1";
                          break;
                          case 2:
                            document.getElementById("portafolio_titulo").innerHTML = "Categoria2";
                          break;
                          case 3:
                            document.getElementById("portafolio_titulo").innerHTML = "Categoria3";
                          break;
                          case 4:
                            document.getElementById("portafolio_titulo").innerHTML = "Categoria4";
                          break;
                          case 5:
                            document.getElementById("portafolio_titulo").innerHTML = "Categoria5";
                          break;
                          case 6:
                            document.getElementById("portafolio_titulo").innerHTML = "Categoria6";
                          break;
                          window.scroll(0, 0);


               }
                
              },
              error: function(){
                      alert('Verifique los datos')      
              }
  })
}