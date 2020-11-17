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
        <a href="./peliculas_form.php" class="btn btn-dark">Formulario</a>&nbsp;&nbsp;
    </div>
    <div class="container">
        <label for='titulo'>Título:</label><br>
        <input type='text' id='titulo'><br><br>
        <h1>Edición de películas</h1>
        <!-- INCLUIR CÓDIGO PHP -->
        <?
         // crear el formulario y lo muestra 
        $formulario = crearForm();
        echo $formulario;
        


        ?>


    </div>

</body>

</html>