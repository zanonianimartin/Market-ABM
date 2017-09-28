<?php
include("conexion.php");

if (!empty($_POST['agregarProducto'])) {
   
   $stmt = $conn->prepare("INSERT INTO productos (nombre,precio,categoria,descripcion) VALUES (?, ?, ?,?)");
   
   $stmt->bind_param('sdss', $nombre, $precio, $categoria, $descripcion);
   $nombre = $_POST['nombre'];
   $precio = $_POST['precio'];
   $categoria = $_POST['subcategoria'];
   $descripcion = $_POST['descripcion'];
    
   $stmt->execute();
   $stmt->close();
   $i = 1;
   $id = $conn->insert_id;
   $foto = 'foto/';
   $cantidad = 1;
   
    while (isset($_POST[$foto.$cantidad])) {
        //echo $_POST[$foto.$cantidad];
        if ($_POST[$foto.$cantidad]!=""){
            cargarfoto($id,$_POST[$foto.$cantidad]);
        }
        
        $cantidad++;
    }

    header('Location: ../productos.php#agregar');

    


   
}



else if (isset($_POST['buscarsubcategoria'])) {
    $categoria= $_POST['categoria'];
    
    $arr = '';

    $consulta = mysql_query("SELECT * FROM categorias WHERE id in (SELECT id_hijo FROM herenciacategorias WHERE id_padre='".$categoria."')" ) or die(mysql_error());
    if (mysql_num_rows($consulta)>0) {
        $id = " <option disabled selected value> -Seleccionar una subcategoria- </option>";
        $arr[] = array($id);
        while ($reg = mysql_fetch_array($consulta)) {
            $id = "<option value='".$reg['id']."'>".$reg['nombre']."</option>";
            

            $arr[] = array($id);
        }
        echo json_encode($arr);
    }
    else{
        $arr[] = array("<option value='' disabled>No hay subcategorias,por favor crear una</option>");
        echo json_encode($arr);
    }
    
}

else if (isset($_POST['buscarprodporcategoria'])) {
    $subcategoria= $_POST['subcategoria'];
    
    $resultado = '';

    $consulta = mysql_query("SELECT P.nombre,P.precio,P.categoria,P.descripcion, C.nombre, P.id FROM productos P ,categorias C WHERE (P.categoria ='".$subcategoria."') AND (C.id='".$subcategoria."' )" ) or die(mysql_error());
    if (mysql_num_rows($consulta)>0) {
        while ($reg = mysql_fetch_array($consulta)) {
            //$idborrar = (string)$reg[0]."/".(string)$reg[5] ;
            $nombreprod = "<tr><td>".$reg[0]."</td>";
            $precioprod = "<td>".$reg[1]."</td>";
            $categoriaprod = "<td>".$reg[4]."</td>";
            $descripcionprod = "<td>".$reg[3]."</td>";
            $borrar = "<td><button id='borrar' type='button' class='btn btn-danger' onclick= 'eliminarProducto(";
            $borrar = $borrar.'"'.$reg[0]."/".$reg[5].'"';
            $borrar = $borrar.")'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td></tr>";
            
            
            $resultado[] = array($nombreprod,$precioprod,$categoriaprod,$descripcionprod,$borrar);
        }
        echo json_encode($resultado);
    }
    else{
        $resultado[] = array("No hay resultados para la busqueda.");
        echo json_encode($resultado);
    }
    
}

else if (isset($_POST['borrarproducto'])) {
    
    $stmt = $conn->prepare("DELETE FROM `productos` WHERE `productos`.`id` = ?");
    
    $stmt->bind_param('i', $idproducto);
    $idproducto = $_POST['borrarproducto'];
    $stmt->execute();
    $stmt->close();
}

else if (isset($_POST['listarUltimosProductos'])) {
    $resultado = '';
    
    $consulta = mysql_query("SELECT P.nombre,P.precio,P.categoria,P.descripcion, C.nombre, P.id FROM productos P ,categorias C WHERE (P.categoria =C.id) ORDER BY id DESC LIMIT 20" ) or die(mysql_error());
    if (mysql_num_rows($consulta)>0) {
        while ($reg = mysql_fetch_array($consulta)) {
            //$idborrar = (string)$reg[0]."/".(string)$reg[5] ;
            $nombreprod = "<tr id='".$reg[0]."/".$reg[5]."'><td>".$reg[0]."</td>";
            $precioprod = "<td>".$reg[1]."</td>";
            $categoriaprod = "<td>".$reg[4]."</td>";
            $descripcionprod = "<td>".$reg[3]."</td>";
            $borrar = "<td><button id='borrar' type='button' class='btn btn-danger' onclick= 'eliminarProducto(";
            $borrar = $borrar.'"'.$reg[0]."/".$reg[5].'"';
            $borrar = $borrar.")'><span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></td></tr>";
            
            
            $resultado[] = array($nombreprod,$precioprod,$categoriaprod,$descripcionprod,$borrar);
        }
        echo json_encode($resultado);
    }
    else{
        $resultado[] = array("No hay resultados para la busqueda.");
        echo json_encode($resultado);
    }
    
}
else if (isset($_GET['key'])) {
    $key=$_GET['key'];
    $array ='';
    $consulta = mysql_query("select * from productos WHERE nombre LIKE '%{$key}%'");
    while($row=mysql_fetch_assoc($query))
    {
    $array[] = $row['nombre'];
    }
echo json_encode($array);
}

function cargarfoto($idprod, $fotoprod)
{   include("conexion.php");
    $stmt = $conn->prepare("INSERT INTO fotosproductos (id_prod,foto) VALUES (?, ?)");
    $stmt->bind_param('is',$id,$foto);
    $id = (int)$idprod;
    $foto = $fotoprod;
    $stmt->execute();
    $stmt->close();
}


?>