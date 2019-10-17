
      try{ 
           
              var lista_compra = Cookies.get('lista_compra');
              var lista = JSON.parse(lista_compra);
              if (typeof lista_compra === 'undefined') {
              var lista = []; 
              }

          }
      catch(e){ 
              console.log(e);
              var lista = [];
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


//eliminar producto de la lista
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
                      Cookies.set('lista_compra',lista, { expires: 90 });
                     }
              }

          swal("Producto eliminado de tu lista", {
            icon: "success",
          });
          $("#prod_carro").text(lista.length);
          modalListaProd()
        } 
      });

}


//modal lista
  function modalListaProd() {

    $("#tbody_modalprod").empty();

    fLen = lista.length;



    if (parseInt(fLen) <= 0) {
      swal("Agrega productos a tu lista", {
                        icon: "warning",
                      }); 

      $("#btn_guardar").css("display","none");
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
    

  }




//volver a busqueda
    function volver(){
            $("#formbuscar").css("visibility", "visible");
            $("#map").css("display", "none");

            $("#volver").css("display", "none");
            $("#producto").val("");
    }


//agregar producto a la lista
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
                    //console.log(producto[1]);
                         producto[1] = parseInt(producto[1]) + parseInt(cant);
                    swal("Producto Sumado", prod + " "+producto[1]+" en total", "success");
                       }
                  
                });
              }
              //console.log(lista);
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



//menu mobile
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


$(document).ajaxStart(function() {
          $("#formbuscar").hide();
          $("#loading").show();
             }).ajaxStop(function() {
          $("#loading").hide();
          $("#formbuscar").show();
    }); 



//Busqueda
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
              window.scroll(0, 0);
                
              },
              error: function(){
                      alert('Verifique los datos')      
              }
            });
            return false;
          });
        });    



//guardar lista
function guardarLista(usu)
        {

            swal({
              text: 'Ingresa el nombre de la lista',
              content: "input",
              button: {
                text: "Guardar Lista",
                closeModal: false,
              },
            })
            .then(nomLista => {
              if (!nomLista) throw null;

                          var TableData = new Array();
    
                          $('#tabla_prod tr').each(function(row, tr){
                TableData[row]={
                  "prod" : $(tr).find('td:eq(0)').text()
                    ,"cant" : $(tr).find('td:eq(3)').text()
                }


            }); 
            TableData.shift();  // first row will be empty - so remove
            TableData = JSON.stringify(TableData);

            $('#tbConvertToJSON').val('JSON array: \n\n' + TableData.replace(/},/g, "},\n"));
            $.ajax({
                type: "POST",
                url: "controles/controlGuardarLista.php",
                data:   { "data" : TableData, "usu":usu, "nomLista":nomLista},
                cache: false,
                success: function(result){
           var msg = result.trim();

               switch(msg) {
            case '-1':
                swal("Error Base de Datos", "Error de base de datos, comuniquese con el administrador", "warning");
                break;
            default:
                swal("Lista Guardada!", msg, "success");
              }
      },
      error: function(){
              swal("Error", "favor verifique sus datos e intente nuevamente o comuniquese con su Administrador de Sistema", "warning");      
              
      }

            });

              
             
            })
            .catch(err => {
              if (err) {
                swal("Oh no!", "La lista no se a guardado "+err, "error");
              } else {
                swal.stopLoading();
                swal.close();
              }
            });






        

            
        }

