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
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>
    <div class="alert alert-secondary d-flex">
        <a href="./peliculas.php" class="btn btn-dark">Películas</a>&nbsp;&nbsp;
    </div>
    <div class="container">
        <div class="row mx-auto">
            <div class="portada">
                <div class="botones">
                    <button id="editar">Editar</button>
                    <button id="borrar">Borrar</button>
                </div>
            </div>
            
            <!-- INCLUIR CÓDIGO PHP -->
            <?php
            // lee el fichero de peliculas
            $array = get_dataCsv("bbdd/peliculas.csv");
            // var_dump($array);
            // echo "<br>";
            // echo "<br>";
            // // retorna el ID y el Nombre de la pelicula en un array
            // $arrayDatos = getIdyName($array);
            // var_dump("id y nom: ".$arrayDatos);

            
            


            ?>
            </tbody>
        </table>
        </div>
    </div>
</body>

</html>