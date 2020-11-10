function saludarArchivo(){
    alert("Saludo desde archivo");
}

function leerValores(){
    var nombre=document.getElementById('nombre').value
    document.getElementById('resultado'+1).innerHTML=nombre
    
}

//var mostrarValor = function(y,x){
//    
//    document.getElementById('codigo').value = y; 
//    document.getElementById('nombre').value = x;
//
//};
 alert("Estoy en ajax");  
    
  $('#btnGuardar').click(function(event){  
      
    alert("Estoy en ajax");               
                var n= $('#nombre').val();
                var a = $('#apellido').val();
                var t = $('#mail').val();
                 var c = $('#cedula').val();
               
                $.ajax({
                    type: "POST",
                    data: {"nombre" : n, "apellido" : a, "mail" : t, "cedula" : c},
                    url: "?controlador=Item&accion=insertarP",
                    beforeSend: function () {
                      //  $('#imgLoad').show();
                    },
                    success: function(response) { 
                        //$('#lblDatos').text(response);                           
                    },
                }
            }));