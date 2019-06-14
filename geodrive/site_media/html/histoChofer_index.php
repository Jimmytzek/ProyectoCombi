<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>

<h1>Chofer</h1>
<br>

<table class="table" id="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Primer Apellido</th>
      <th scope="col">Segundo Apellido</th>
      <th scope="col">Fecha Inicio</th>
      <th scope="col">Fecha Termino</th>
      <th scope="col">Estatus</th>
    </tr>
  </thead>
</table>

<button onclick="location='./../html/histoChofer_reporte.php'">click para generar reporte</button>

<script>
    (function(){
        verChofer();
    })();
function verChofer(){
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText); 
                    var table = document.getElementById("table");

                    response.forEach(item=>{
                        var row = table.insertRow(1);

                        // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);
                        var cell3 = row.insertCell(2);
                        var cell4 = row.insertCell(3);
                        var cell5 = row.insertCell(4);
                        var cell6 = row.insertCell(5);

                        // Add some text to the new cells:
                        cell1.innerHTML = item.Nombre;
                        cell2.innerHTML = item.PrimerApellido;
                        cell3.innerHTML = item.SegundoApellido;
                        cell4.innerHTML = item.FechaInicio;
                        cell5.innerHTML = item.FechaTermino;
                        cell6.innerHTML = item.Estatus;
                    });
				}
			};
			xhttp.open("GET", "http://localhost/api.combis.com/v1/historialChofer/verHistorial", true);
			xhttp.send();}
</script>


</body>
</html>