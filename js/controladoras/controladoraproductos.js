function loadAgregar() {
    $("#container").load("includes/productos/agregar.php");
}
function loadEliminar() {
    $("#container").load("includes/productos/eliminar.php");
}


function eliminarProducto(id) {
    idfila = id;
    id = id.split("/");
    var confirmar = confirm("Seguro que quiere borrar el producto "+id[0]+"?");
    if (confirmar) {
        console.log("Lo borra");
        jQuery.ajax({
            type:'POST',
            data:{'borrarproducto':id[1]},
            url:'db/controladora.php',
 
            success: function (data) {
                alert("Se borro el producto "+id[0]);
                var parent = document.getElementById("resultado");
                var child = document.getElementById(idfila);
                parent.removeChild(child);

            }
        });
    }
    
}
function listarUltimosProductos() {
    var arr = "";
    jQuery.ajax({
        type:'POST',
        data:{'listarUltimosProductos':'1'},
        url:'db/controladora.php',

        success: function (data) {
            console.log(arr);
               arr = JSON.parse(data);
               jQuery('#resultado').empty();
               jQuery.each(arr,function(i,val) {
                
                   jQuery('#resultado').append(i+val);
               });
               
           }
    });
}
$(document).ready(function(){
    $('input.typeahead').typeahead({
        name: 'typeahead',
        remote:'search.php?key=%QUERY',
        limit : 10
    });
});