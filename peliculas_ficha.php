<?php
include('lib/utils.php');
?>
<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Películas | Ficha</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilos.css">
</head>

<body>
    <div class="alert alert-secondary d-flex">
        <a href="./peliculas.php" class="btn btn-dark">Películas</a>&nbsp;&nbsp;
    </div>
    <div class="container">
    <!-- INCLUIR CÓDIGO PHP -->
    <?php
        // el id que llega a través de la url por get
        $idPeli = $_GET['id']; 

        // lee y guarda en arrays los datos de cada archivo csv
        $arrayPelis = get_dataCsv(PELISCSV);
        $arrayAct = get_dataCsv(ACTORESCSV);
        $arrayDir = get_dataCsv(DIRESCSV);
        $arrayPA = get_dataCsv(PELIACTCSV);
        $arrayPD = get_dataCsv(PELIDIRCSV);

        // devuelve el id de los actores con el id de la pelicula
        $actores = buscarDatosPeli($idPeli, $arrayPA);
        // devuelve el id de los directores con el id de la pelicula
        $directores = buscarDatosPeli($idPeli, $arrayPD);
                
        $posicionPeli = buscarPosicion($idPeli, $arrayPelis);
        muestraFicha($posicionPeli, $arrayPelis);// $posicionAct, $arrayAct, $posicionDir, $arrayDir);
        echo "<p><strong>Actores:</strong></p>";
        sacar_Nombre($actores, $arrayAct);
        echo "<p><strong>Directores:</strong></p>";
        sacar_Nombre($directores, $arrayDir);
        

    ?>

    </div>
</body>

</html>