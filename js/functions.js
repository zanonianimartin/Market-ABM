function productos() {
    var cargar = location.hash.replace("#", "");
    var cargar = cargar.split("/");
    if (cargar=="agregar") {
        loadAgregar();
    }
    else if (cargar=="eliminar") {
        loadEliminar();
    }
    else if (cargar=="modificar") {
        loadModificar();
    }
}
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57))){
        return false;
    }
        
    return true;
}
function masfotos() {
    var div = document.getElementById("foto");
    var ultimo = div.lastElementChild;
    var id = ultimo.id;
    id = id.split("/");
    var cont = parseInt(id[1])+1;
    console.log(id);

    //var ultimo = div.lastChild.attr('id');
    //div.appendChild()
    $(`<br><input id="foto/`+cont+`" name="foto/`+cont+`" class="input-file" type="file">`).appendTo('#foto');
}
function validarCamposAgregarProductos(){
    var precio = document.getElementById("precio").value;
    var tipo = parseInt(precio);
    if (typeof tipo == 'NaN') {
        alert("el precio debe ser un numero!");
        return false;
    }
    
}

function buscarsubcategorias() {
       var categoria = jQuery("#categoria").val();
       var arr = "";
       var buscarsubcategoria ="";
       jQuery.ajax({
           type:'POST',
           data:{'buscarsubcategoria':buscarsubcategoria, 'categoria':categoria},
           url:'db/controladora.php',

           success: function (data) {
               arr = JSON.parse(data);
               jQuery('#subcategoria').empty();
               jQuery.each(arr,function(i,val) {
                
                   jQuery('#subcategoria').append(i+val);
               });
           }
       });
}

function buscarprodporcategoria() {
    var subcategoria = jQuery("#subcategoria").val();
    var arr = "";
    var buscarprodporcategoria ="";
    //console.log(categoria); 
    jQuery.ajax({
        type:'POST',
        data:{'buscarprodporcategoria':buscarprodporcategoria, 'subcategoria':subcategoria},
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


$(document).ready(function() {
    $('#agregarProducto').click(function() 
    { 
        var imgVal = $('#foto/1').val(); 
        if(imgVal=='') 
        { 
            alert("Se debe cargar una imagen principal"); 
            return false; 
        } 


    }); 
});