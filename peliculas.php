<?php
include('lib/utils.php');
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Películas</title>
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
        <div class="row mx-auto">

            <!-- INCLUIR CÓDIGO PHP -->
            <?php
            $array = get_dataMovies("bbdd/peliculas.csv");
            //var_dump($array);
            echo "<br>";

            $pelisAsocia = null;
            for ($i=0 ; $i < count($array) ; $i++) {
                echo "<br>";
                //for ($j=0; $j < count($array[$i]); $j++) {
                    $pelisAsocia['ID'] = $array[$i][0];
                    $pelisAsocia['Nombre'] = $array[$i][1];
                    $pelisAsocia['Año'] = $array[$i][2];
                    $pelisAsocia['Duración'] = $array[$i][3];

                    var_dump($pelisAsocia);
                    
                echo "<br>";
            }
            // for ($i=0 ; $i < count($array) ; $i++) {
            //     echo "<br>";
            //     for ($j=0; $j < count($array[$i]); $j++) {
            //     echo $array[$i][$j]."</br>";
            //     }
            //     echo "<br>";
            // }
            ?>

        </div>
    </div>
</body>

</html>