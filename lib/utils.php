<?php
// lee el fichero peliculas.csv
function get_dataCsv($nombreFichero){
    $archivo = fopen($nombreFichero, "r");

    if($archivo) {
        $linea = fgetcsv($archivo, ","); // de cada linea coge lo que haya entre "," en este caso
        $arrayLineas = null;
        $contador = 0;
        while ($linea !== false) {
        // almacenamos en un array los datos leídos
        $arrayLineas[$contador] = $linea;
        $contador++;
        $linea = fgetcsv($archivo, ",");
        }
    } else {
    echo "El fichero no existe";
    }
    fclose($archivo);
    
    return $arrayLineas;

}

function get_Portadas($nombreArray){

    for ($i=0; $i < count($nombreArray); $i++){
        $id= $nombreArray[$i][0];
        $nombre = $nombreArray[$i][1];
        $archivoJpg = $id.'.jpg';
        $carpeta = 'imgs/peliculas/';
        $dir = $carpeta.$archivoJpg;  // Ruta donde se guarda la imagen
        $imgag = "<img src='$dir' alt='Esta es la portada' width = 175 height= 300;>";
        $enlace = "<a href=''>$imgag</a>";
        $titulo = "<p>$nombre</p>";
        $botones = "<div class='botones'><button id='editar'>Editar</button><button id='borrar'>Borrar</button></div>";
        $portada = "<div class='portada'>$enlace $titulo $botones</div>";

        echo $portada;
    }

}
?>