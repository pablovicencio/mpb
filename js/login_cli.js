
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



  function isMobile() {

          try{ 
              document.createEvent("TouchEvent"); 
              $("#menuMob").css("display", "block");
              $("#menuMobFoo").css("display", "block");
              $("#prod_carro").text(lista.length);
              console.log(lista);
          }
          catch(e){ 
              $("#menuDesk").css("display", "block");
              $("#prod_carro").text(lista.length);
              console.log(lista);
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



//gif cargando
$(document).ajaxStart(function() {
  $("#login").hide();
  $("#loading").show();
     }).ajaxStop(function() {
  $("#loading").hide();
  $("#login").show();
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




//login
$(document).ready(function() {
  $("#formLogin").submit(function() {  

    var MD5 = function(d){result = M(V(Y(X(d),8*d.length)));return result.toLowerCase()};function M(d){for(var _,m="0123456789ABCDEF",f="",r=0;r<d.length;r++)_=d.charCodeAt(r),f+=m.charAt(_>>>4&15)+m.charAt(15&_);return f}function X(d){for(var _=Array(d.length>>2),m=0;m<_.length;m++)_[m]=0;for(m=0;m<8*d.length;m+=8)_[m>>5]|=(255&d.charCodeAt(m/8))<<m%32;return _}function V(d){for(var _="",m=0;m<32*d.length;m+=8)_+=String.fromCharCode(d[m>>5]>>>m%32&255);return _}function Y(d,_){d[_>>5]|=128<<_%32,d[14+(_+64>>>9<<4)]=_;for(var m=1732584193,f=-271733879,r=-1732584194,i=271733878,n=0;n<d.length;n+=16){var h=m,t=f,g=r,e=i;f=md5_ii(f=md5_ii(f=md5_ii(f=md5_ii(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_hh(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_gg(f=md5_ff(f=md5_ff(f=md5_ff(f=md5_ff(f,r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+0],7,-680876936),f,r,d[n+1],12,-389564586),m,f,d[n+2],17,606105819),i,m,d[n+3],22,-1044525330),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+4],7,-176418897),f,r,d[n+5],12,1200080426),m,f,d[n+6],17,-1473231341),i,m,d[n+7],22,-45705983),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+8],7,1770035416),f,r,d[n+9],12,-1958414417),m,f,d[n+10],17,-42063),i,m,d[n+11],22,-1990404162),r=md5_ff(r,i=md5_ff(i,m=md5_ff(m,f,r,i,d[n+12],7,1804603682),f,r,d[n+13],12,-40341101),m,f,d[n+14],17,-1502002290),i,m,d[n+15],22,1236535329),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+1],5,-165796510),f,r,d[n+6],9,-1069501632),m,f,d[n+11],14,643717713),i,m,d[n+0],20,-373897302),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+5],5,-701558691),f,r,d[n+10],9,38016083),m,f,d[n+15],14,-660478335),i,m,d[n+4],20,-405537848),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+9],5,568446438),f,r,d[n+14],9,-1019803690),m,f,d[n+3],14,-187363961),i,m,d[n+8],20,1163531501),r=md5_gg(r,i=md5_gg(i,m=md5_gg(m,f,r,i,d[n+13],5,-1444681467),f,r,d[n+2],9,-51403784),m,f,d[n+7],14,1735328473),i,m,d[n+12],20,-1926607734),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+5],4,-378558),f,r,d[n+8],11,-2022574463),m,f,d[n+11],16,1839030562),i,m,d[n+14],23,-35309556),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+1],4,-1530992060),f,r,d[n+4],11,1272893353),m,f,d[n+7],16,-155497632),i,m,d[n+10],23,-1094730640),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+13],4,681279174),f,r,d[n+0],11,-358537222),m,f,d[n+3],16,-722521979),i,m,d[n+6],23,76029189),r=md5_hh(r,i=md5_hh(i,m=md5_hh(m,f,r,i,d[n+9],4,-640364487),f,r,d[n+12],11,-421815835),m,f,d[n+15],16,530742520),i,m,d[n+2],23,-995338651),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+0],6,-198630844),f,r,d[n+7],10,1126891415),m,f,d[n+14],15,-1416354905),i,m,d[n+5],21,-57434055),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+12],6,1700485571),f,r,d[n+3],10,-1894986606),m,f,d[n+10],15,-1051523),i,m,d[n+1],21,-2054922799),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+8],6,1873313359),f,r,d[n+15],10,-30611744),m,f,d[n+6],15,-1560198380),i,m,d[n+13],21,1309151649),r=md5_ii(r,i=md5_ii(i,m=md5_ii(m,f,r,i,d[n+4],6,-145523070),f,r,d[n+11],10,-1120210379),m,f,d[n+2],15,718787259),i,m,d[n+9],21,-343485551),m=safe_add(m,h),f=safe_add(f,t),r=safe_add(r,g),i=safe_add(i,e)}return Array(m,f,r,i)}function md5_cmn(d,_,m,f,r,i){return safe_add(bit_rol(safe_add(safe_add(_,d),safe_add(f,i)),r),m)}function md5_ff(d,_,m,f,r,i,n){return md5_cmn(_&m|~_&f,d,_,r,i,n)}function md5_gg(d,_,m,f,r,i,n){return md5_cmn(_&f|m&~f,d,_,r,i,n)}function md5_hh(d,_,m,f,r,i,n){return md5_cmn(_^m^f,d,_,r,i,n)}function md5_ii(d,_,m,f,r,i,n){return md5_cmn(m^(_|~f),d,_,r,i,n)}function safe_add(d,_){var m=(65535&d)+(65535&_);return(d>>16)+(_>>16)+(m>>16)<<16|65535&m}function bit_rol(d,_){return d<<_|d>>>32-_}

          var mail =    $("#mail_usu").val();
          var pwd =    MD5(unescape(encodeURIComponent($("#pass_usu").val())));
		  
  	 $.ajax({
      type: "POST",
      url: '../controles/controlLogin.php',
      data:{"mail":mail, "pwd":pwd},
      success: function (result) { 
              var msg = result.trim();

                switch(msg) {
                        case '0':
                            //REVISAR ESTA RUTA CUANDO PASE A PRODUCCION
                            //var dominio = window.location.hostname;
                            //var carpeta = window.location.pathname;
                            //console.log(dominio+carpeta+"pag_usu/inicio.php");
                            window.location= "../vista/vistaMicuenta.php";
                            break;
                        case '-1':
                            swal("Error Base de Datos", "Error de base de datos, comuniquese con el administrador", "warning");
                            break;
                        case '-2':
                            swal("Error", "favor verifique sus datos e intente nuevamente o comuniquese con su Administrador de Sistema", "warning");
                            break;
                        

                    }
      },
      error: function(){
              swal("Error", "favor verifique sus datos e intente nuevamente o comuniquese con su Administrador de Sistema", "warning");      
              
      }
    });
    return false;
  });
});



//crear usuario
$(document).ready(function() {
  $("#formCreUsu").submit(function() {  
     $.ajax({
      type: "POST",
      url: '../controles/controlCrearUsu.php',
      data:$("#formCreUsu").serialize(),
      success: function (result) { 
              var msg = result.trim();

               switch(msg) {
            case '-1':
                swal("Error Base de Datos", "Error de base de datos, comuniquese con el administrador", "warning");
                break;
            case '-2':
                swal("Error Mail", "Favor ingrese un correo electronico para enviar las credenciales", "warning");
                break;
            case '-3':
                swal("Mail Duplicado", "El Mail ya se encuentra en el sistema, puede encontrarse sin vigencia", "warning");
                break;
            default:
                swal("Usuario Creado!", msg, "success");
              }
      },
      error: function(){
              swal("Error", "favor verifique sus datos e intente nuevamente o comuniquese con su Administrador de Sistema", "warning");      
              
      }
    });
    return false;
  });
});