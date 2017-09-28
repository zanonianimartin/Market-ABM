<?php
    include('../../db/conexion.php');

    $server = mysql_connect($servername, $username, $password); 
    $db = mysql_select_db("market", $server); 
    $query = mysql_query("SELECT * FROM categorias WHERE final = false"); 

        
?>
<div class="row">
                <div>
                    <div class="col-md-7">
                        <form class="form-inline">
                            <div class="form-group" class="col-md-6">
                            <label for="subcategoria">Categoria</label>
                                <select id="categoria" name="categoria" class="form-control"required="" onchange="buscarsubcategorias()">
                                    <option disabled selected value> -Seleccionar una categoria- </option>
                                    <?php
                                    while ($row = mysql_fetch_array($query)) {
                                        echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                                    }
                                    ?>
                                
                                </select>
                            </div>
                            <div class="form-group" >
                                <div>
                                <label for="subcategoria">Subcategoria</label>
                                    <select onchange="buscarprodporcategoria()" id="subcategoria" name="subcategoria" class="form-control"required="">
                                        
                                    
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5">
                        <form class="form-inline">
                        <input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Type your Query">
                        <button type="submit" class="btn btn-default" >
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>Buscar
                            </button>
                            <button type="submit" class="btn btn-primary" onclick="listarUltimosProductos()">
                                    Ultimos agregados
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <div id="tablaproductos">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Categoria</th>
                            <th>Descripcion</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody id="resultado">
                        
                    </tbody>
                
                </table>
            </div>