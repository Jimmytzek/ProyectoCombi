$(document).on('ready', funcMain);


function funcMain()
{
 

 
	$("loans_table").on('click','#fa-edit',editProduct);
 
	$("body").on('click',"#fa-edit",editProduct);
}
 


function editProduct(){ 
	var _this = this;;
	var array_fila=getRowSelected(_this);
    console.log(array_fila[0]+" _ "+array_fila[1]+" _ "+array_fila[2]+
    " _ "+array_fila[3]+" _ "+array_fila[4]+" _ "+array_fila[5]+" _ "+
    array_fila[6]+" _ "+array_fila[7]+" _ "+array_fila[8]+" _ "+array_fila[9]+" _ "+array_fila[10]+" _ "+array_fila[11] );
  
    document.getElementById("id").value = array_fila[0];
    document.getElementById("nombre").value = array_fila[1];
    document.getElementById("PA").value = array_fila[2];
    document.getElementById("SA").value = array_fila[3];
    document.getElementById("fecha").value = array_fila[4];
    document.getElementById("estado").value = array_fila[5];
    document.getElementById("localidad").value = array_fila[6];
    document.getElementById("colonia").value = array_fila[7];
    document.getElementById("calle").value = array_fila[8];
    document.getElementById("nDomicilio").value = array_fila[9];
    document.getElementById("correo").value = array_fila[11];  

}



function getRowSelected(objectPressed){ 

	var a=objectPressed.parentNode.parentNode;
 
    
    var id = a.getElementsByTagName("td")[0].getElementsByTagName("p")[0].innerHTML; 
    var nom =  a.getElementsByTagName("td")[1].getElementsByTagName("p")[0].innerHTML;
    var pa =a.getElementsByTagName("td")[2].getElementsByTagName("p")[0].innerHTML;
    var sp = a.getElementsByTagName("td")[3].getElementsByTagName("p")[0].innerHTML;
    var f= a.getElementsByTagName("td")[4].getElementsByTagName("p")[0].innerHTML;
    var e= a.getElementsByTagName("td")[5].getElementsByTagName("p")[0].innerHTML;
    var l = a.getElementsByTagName("td")[6].getElementsByTagName("p")[0].innerHTML;
    var co= a.getElementsByTagName("td")[7].getElementsByTagName("p")[0].innerHTML;
    var ca = a.getElementsByTagName("td")[8].getElementsByTagName("p")[0].innerHTML;
    var nd = a.getElementsByTagName("td")[9].getElementsByTagName("p")[0].innerHTML;
    var correo = a.getElementsByTagName("td")[10].getElementsByTagName("p")[0].innerHTML;

   
    var array_fila = [ id ,nom , pa, sp, f, e, l, co, ca, nd, ,correo];
 
    return array_fila;
}
 