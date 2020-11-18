<?php
include('lib/utils.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Edición de películas</title>
</head>

<body>
<div class="alert alert-secondary d-flex">
<a href="./peliculas.php" class="btn btn-dark">Películas</a>&nbsp;&nbsp;
    </div>
    <div class="container">
        <h1>Edición de películas</h1>
        <!-- INCLUIR CÓDIGO PHP -->
        <?
        //tener en cuenta la validacion isset... pattern EVITAR CODIGO MALICIOSO html (PARTE CLIENTE Y EN EL SERVIDOR) PRUEBAS
         // crear el formulario relleno con datos pelicula y lo muestra 
        $id = $_GET['id'];
        $titol = $_GET['nombre'];
        $any = $_GET['anyo'];
        $duracio = $_GET['duracion'];
        crearForm($id, $titol, $any, $duracio);
 
        ?>


    </div>

</body>

</html>