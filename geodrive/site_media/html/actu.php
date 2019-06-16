 
<script>
 
(function(){
        verCombis();

    })();
function verCombis(){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText); 
                    var table = document.getElementById("table");
                    // id="pass" value="" 
                    
                    response.forEach(item=>{

                        //  document.getElementById("id").value = '<p>'+item.ID_Usuario+'<p>';
            
                        var row = table.insertRow(1);
                        

                         
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);
                        var cell6 = row.insertCell(5);
                        var cell7 = row.insertCell(6);
                        var cell8 = row.insertCell(7);
                        var cell9 = row.insertCell(8);
                        var cell10 = row.insertCell(9); 
                        var cell11 = row.insertCell(10);
                        var cell12 = row.insertCell(11); 
                        

                        // Add some text to the new cells:
                        
                        cell1.innerHTML= '<p name="nDomicilio" class="non-margin" id="id">'+item.ID_Usuario+'</p>'; 
                        cell2.innerHTML = '<p name="nombre" class="non-margin">'+item.Nombre+'</p>';
                        cell3.innerHTML = '<p name="PA" class="non-margin">'+item.Primer_Apellido+'</p>';
                        cell4.innerHTML = '<p name="SA" class="non-margin">'+item.Segundo_Apellido+'</p>';
                        cell5.innerHTML = '<p name="fecha" class="non-margin">'+item.Fecha_Nacimiento+'</p>';
                        cell6.innerHTML = '<p name="estado" class="non-margin">'+item.Estado+'</p>';
                        cell7.innerHTML = '<p name="localidad" class="non-margin">'+item.Localidad+'</p>';
                        cell8.innerHTML = '<p name="colonia" class="non-margin">'+item.Colonia+'</p>';
                        cell9.innerHTML = '<p name="calle" class="non-margin">'+item.Calle+'</p>';
                        cell10.innerHTML = '<p name="nDomicilio" class="non-margin">'+item.Numero_Domicilio+'</p>';
                        cell11.innerHTML = '<p name="nDomicilio" class="non-margin">'+item.Correo+'</p>';
                        
                        // cell12.innerHTML = '<p name="nDomicilio" class="non-margin">'+item.ID_Usuario+'</p>';
                        cell12.innerHTML= '<button id="fa-edit">Actualizar </button>'; 
                        // cell12.innerHTML = '<p name="nDomicilio" class="non-margin">'+item.ID_Usuario+'</p>';
                
                        
                        


                        
                        
                    });
				}
			};
			xhttp.open("GET", "http://localhost/api.combis.com/v1/usuarios/verUsuarios", true);
			xhttp.send();}
 
</script>



    <script>

    function registro(){

    var from= {
        Nombre: $('#nombre').val(), 
        Primer_Apellido: $('#PA').val(),
        Segundo_Apellido: $('#SA').val(),
        Fecha_Nacimiento: $('#fecha').val(),
        Estado: $('#estado').val(),
        Localidad: $('#localidad').val(),
        Colonia: $('#colonia').val(),
        Calle: $('#calle').val(),
        Numero_Domicilio: $('#nDomicilio').val(),
        Correo: $('#correo').val(),
        Contrasena: $('#pass').val(),
        ID_Usuario: $('#id').val()
        
  
    };
 

    var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                         alert('Cambio Realizado'); 
 
                        window.location="usuario_update.php";


                    }
                };
                xhttp.open("PUT", "http://localhost/api.combis.com/v1/usuarios/update", true);
                xhttp.send(JSON.stringify(from));


    }
 
    </script> 


 
  