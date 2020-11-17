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
        $imgag = "<img src='$dir' alt='Esta es la portada' width = 175 height= 300>";
        $enlace = "<a href='peliculas_ficha.php'>$imgag</a>"; // TIENE QUE LLEVAR A LA FICHA DE LA PELICULA
        $editar = "<a href='peliculas_form.php'><button id='editar'>Editar</button></a>";
        $borrar = "<a href='peliculas_borrado.php'><button id='borrar'>Borrar</button></a>";
        $titulo = "<p>$nombre</p>";
        $botones = "<div class='botones'>$editar $borrar</div>";
        $portada = "<div class='portada'>$enlace $titulo $botones</div>";

        echo $portada;  
    }
    return $id;
}

/* borrará la pelicula que le indiquemos mediante el id
 (borrará la linea del fichero donde aparece) */
function borrar_pelicula($nombreArchivo, $numId){
    //leemos el archivo 
    $fichero = fopen($nombreArchivo, "r");
    // almacenara la data
    $datos = "";
    // contador de lineas
    $i =0;
    if ($fichero) {
        while (($linea = fgets($fichero)) !== false) {
            // aumentamos en 1 la linea
            $i++;
            // borramos espacios de mas con trim()
            $line = trim(preg_replace('/\s+/', ' ', $line));
            /* validamos que sea una linea en blanco o el numero de linea especificado 
            y saltamos a la siguiente interacion */
            if ( $linea == "" || $numId == ($i -1)) continue;

            // almacenamos los resultados
            $datos .= $linea."\n";  
        }
        // cerramos el archivo
        fclose($fichero);
    } else {
    die(" No se pudo abrir el archivo $nombreArchivo");
    }

    // re abrimos en modo escritura
    $handle = fopen($file, "w+");
    // escribimos la nueva data
    fwrite($handle, $result);
    // cerramos el archivo
    fclose($handle);
}

function crearForm(){

    $titulo = "<label for='titulo'>Título:</label><br><input type='text' id='titulo'><br><br>";
    $anyo = "<label for='anyo'>Año:</label><br><input type='number' id='anyo'><br><br>";
    $duracion = "<label for='duracion'>Duración:</label><br><input type='text' id='duracion'><br><br>";
    $guardar = "<input type='submit' value='Guardar'><br><br>";
    $formEdicion = "<form action='' method='post'id='formulario'>$titulo $anyo $duracion $guardar</form>" ;
    echo $formEdicion;
}

?>

