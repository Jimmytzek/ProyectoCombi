<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>

<table class="table" id="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Numero de combi</th>
      <th scope="col">Placas</th>
    </tr>
  </thead>
</table>

<button onclick = "location='./../html/combi_reporte.php'" >click</button>

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

                    response.forEach(item=>{
                        var row = table.insertRow(1);

                        // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                        var cell1 = row.insertCell(0);
                        var cell2 = row.insertCell(1);

                        // Add some text to the new cells:
                        cell1.innerHTML = item.Numero_Combi;
                        cell2.innerHTML = item.Placas;
                    });
				}
			};
			xhttp.open("GET", "http://localhost/api.combis.com/v1/combis/verCombis", true);
			xhttp.send();}
</script>

</body>
</html>