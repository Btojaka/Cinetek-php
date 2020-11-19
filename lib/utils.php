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
        // guarda en cada variable el valor en cada iteración para enviarlo por url
        $id= $nombreArray[$i][0];
        $nombre = $nombreArray[$i][1];
        $anyo = $nombreArray[$i][2];
        $duracion = $nombreArray[$i][3];

        $archivoJpg = $id.'.jpg';
        $carpeta = 'imgs/peliculas/';
        $dir = $carpeta.$archivoJpg;  // Ruta donde se guarda la imagen
        $imgag = "<img src='$dir' alt='Esta es la portada' width = 175 height= 300>";
        $enlace = "<a href='peliculas_ficha.php?id=$id'>$imgag</a>"; // TIENE QUE LLEVAR A LA FICHA DE LA PELICULA
        $editar = "<a href='peliculas_form.php?id=$id&nombre=$nombre&anyo=$anyo&duracion=$duracion'><button id='editar'>Editar</button></a>";
        $borrar = "<a href='peliculas_borrado.php?id=$id'><button id='borrar'>Borrar</button></a>";
        $titulo = "<p>$nombre</p>";
        $botones = "<div class='botones'>$editar $borrar</div>";
        $portada = "<div class='portada'>$enlace $titulo $botones</div>";

        echo $portada;  
    }
}

function crearForm($id, $title, $year, $length){
    //tener en cuenta la validacion isset... pattern EVITAR CODIGO MALICIOSO html (PARTE CLIENTE Y EN EL SERVIDOR) PRUEBAS
         // crear el formulario relleno con datos pelicula y lo muestra
    $numid = "<input type='hidden' name='id' value= '$id'><br><br>";
    $titulo = "<label for='titulo'>Título:</label><br><input type='text' name='titulo' value= '$title'><br><br>";
    $anyo = "<label for='anyo'>Año:</label><br><input type='number' name='anyo' value= '$year'><br><br>";
    $duracion = "<label for='duracion'>Duración:</label><br><input type='text' name='duracion' value= '$length'><br><br>";
    $guardar = "<input type='submit' value='Guardar'><br><br>";
    $formEdicion = "<form action='peliculas_edicion.php' method='GET'name='formulario'>$numid $titulo $anyo $duracion $guardar</form>" ;
    echo $formEdicion;
    
}

/* borrará la pelicula que le indiquemos mediante el id
 (borrará la linea del fichero donde aparece) */
function borrar_pelicula($nombreArchivo, $numId){
    //leemos el archivo 
    $fichero = fopen($nombreArchivo, "r");
    // almacenara los datos
    $datos = "";
    // contador de lineas
    $i =0;
    if ($fichero) {
        while (($linea = fgets($fichero)) !== false) {
            // aumentamos en 1 la linea
            $i++;
            // borramos espacios de mas con trim()
            $linea = trim(preg_replace('/\s+/', ' ', $linea));
            /* validamos que sea una linea en blanco o el numero de linea especificado 
            y saltamos a la siguiente interacion */
            if ($linea == "" || $numId == ($i -1)) {
                continue;
            }
            // almacenamos los resultados
            $datos .= $linea."\n";  
        }
        // cerramos el archivo
        fclose($fichero);
    } else {
    die(" No se pudo abrir el archivo $nombreArchivo");
    }

    // reabrimos en modo escritura
    $fichero = fopen($nombreArchivo, "w+");
    // escribimos la nueva data
    fwrite($fichero, $datos);
    // cerramos el archivo
    fclose($fichero);
}

// sobreescribirá los campos indicados y mostrará un mensaje al completar la acción.
function editar_pelicula($id, $dato1, $dato2, $dato3){
    $array = file($archivo); // lo carga a un vector
    $mensaje = "<div id='exito'>La pelicula ha sido guardada con éxito</div>";
    foreach($array as $key => $linea){  // recorre el vector pareseando las líneas
        $lineal = explode(',', $linea); //LINEAL
        if ($linea[0] == $id){ 
            // si encuentra la línea modifica el contenido
            $lineal[1] = $dato1;
            $lineal[2] = $dato2;
            $lineal[3] = $dato3;
            // reorganiza la cadena
            $temporal = implode(',', $lineal);
            // la asigna al vector en la posición orginal
            $array[$key] = $temporal;
            // sale del foreach, porque no tiene sentido seguir buscando.
            break;
            }
        }
    // Guarda el vector resultado sobreescribiendo el archivo
    // Unir archivo
    $contenido = implode(PHP_EOL,$array);
    $abrir = fopen($archivo,'w');
    fwrite($abrir,$contenido);
    fclose($abrir);
    echo $mensaje;

    
}

?>

