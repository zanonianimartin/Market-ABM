<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap-theme.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet" />
    </head>
    <body>
        <?php include("includes/nav.html"); ?>
        <?php
            include('db/conexion.php');

            $server = mysql_connect($servername, $username, $password); 
            $db = mysql_select_db("market", $server); 
            $query = mysql_query("SELECT * FROM categorias WHERE final = false"); 

                
        ?>
        <div class="container">
            <div class="row">
                <div>
                    <div class="col-md-8">
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
                    <div class="col-md-4">
                        <form class="form-inline">
                            <input type="text" class="form-control" id="buscarproducto" placeholder="Buscar producto">
                            <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>Buscar
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
                        </tr>
                    </thead>
                    <tbody id="resultado">
                        
                    </tbody>
                
                </table>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/functions.js"></script>
    </body>
</html>