<?php
    include('../../db/conexion.php');

    $server = mysql_connect($servername, $username, $password); 
    $db = mysql_select_db("market", $server); 
    $query = mysql_query("SELECT * FROM categorias WHERE final = false"); 

        
?>
<form name="agregarProducto" class="form-horizontal" onsubmit="return validarCamposAgregarProductos()" action="db/controladora.php" method="post">
        <fieldset>

        <!-- Form Name -->
        <legend>Agregar Producto</legend>

        <!-- Text input-->
        <div class="form-group">
        <label class="col-md-4 control-label" for="nombre">Nombre</label>  
        <div class="col-md-5">
        <input id="nombre" name="nombre" type="text" placeholder="" class="form-control input-md" required="">
            
        </div>
        </div>

        <!-- Prepended text-->
        <div class="form-group">
        <label class="col-md-4 control-label" for="precio">Precio</label>
        <div class="col-md-4">
            <div class="input-group">
            <span class="input-group-addon">$</span>
            <input id="precio" name="precio" class="form-control" onkeypress="return isNumberKey(event)" placeholder="" type="number" min="0" step="0.01" required="">
            </div>
            
        </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
        <label class="col-md-4 control-label" for="categoria">Categoria</label>
        <div class="col-md-5">
            <select id="categoria" name="categoria" class="form-control"required="" onchange="buscarsubcategorias()">
                <option disabled selected value> -Seleccionar una categoria- </option>
                <?php
                while ($row = mysql_fetch_array($query)) {
                    echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                }
                ?>
            
            </select>
        </div>
        </div>
        <div class="form-group">
        <label class="col-md-4 control-label" for="subcategoria">Subcategoria</label>
        <div class="col-md-5">
            <select id="subcategoria" name="subcategoria" class="form-control"required="">
                
            
            </select>
        </div>
        </div>

        <!-- Textarea -->
        <div class="form-group">
        <label class="col-md-4 control-label" for="descripcion">Descripción</label>
        <div class="col-md-4">                     
            <textarea required="" class="form-control" id="descripcion" name="descripcion"></textarea>
        </div>
        </div>

        <!-- File Button --> 
        
        <div class="form-group" >
            <label class="col-md-4 control-label" for="foto">Foto Principal</label>
            <div class="col-md-5" id="foto">
                <input id="foto/1" name="foto/1" class="input-file" type="file" required="">
                
            </div>
            <input  class="btn btn-default" onclick="masfotos()" type="button" value="Cargar mas fotos">
        </div>

        <!-- Button -->
        <div class="form-group">
        <label class="col-md-4 control-label" for="agregar"></label>
        <div class="col-md-4">
            <button type="submit" id="agregarProducto"  name="agregarProducto" value="Submit" class="btn btn-success">Agregar</button>
        </div>
        </div>

        </fieldset>
        </form>
