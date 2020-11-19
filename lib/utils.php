<?php

define ('PELISCSV','bbdd/peliculas.csv');
define ('DIRESCSV','bbdd/directores.csv');
define ('ACTORESCSV','bbdd/actores.csv');
define ('PELIDIRCSV','bbdd/pelicula_director.csv');
define ('PELIACTCSV','bbdd/pelicula_actor.csv');

// busca la posiciónj del elemento a través del id
function buscarPosicion($id, $array){
    for($i=0; $i<count($array); $i++){
        if($array[$i][0]== $id){
            return $i;
        }
    }
    return false;

}
// Imprime lista de nombres según los ids 
function sacar_Nombre($arrayIds, $arrayDatos){

    for($i=0; $i<count($arrayIds); $i++){
        for($j=0; $j<count($arrayDatos); $j++){
            if($arrayIds[$i] == $arrayDatos[$j][0]){
                echo "<ul>";
                echo "<li>".$arrayDatos[$j][1]."</li>";
                echo "</ul>";
            }
        }
    }
}
// buscar a traves del id de pelicula, el dato que le corresponde dentro del array 
function buscarDatosPeli($id, $array){
    $datos= null;
    for($i=0; $i<count($array); $i++){
        if($array[$i][0]== $id){
            $datos[$i] = $array[$i][1];
            
        }
        //var_dump($datos);
        //return $datos;
    }
    return $datos;
    
}


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

// borrará la pelicula que le indiquemos mediante el id (borrará la linea del fichero donde aparece) e indicará mensaje de éxito
function borrar_pelicula($numId){
    $archivo = fopen(PELISCSV, "r");
    $mensaje = "<div id='exito'>La pelicula ha sido borrada con éxito</div>";

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
    $posicion = buscarPosicion($numId, $arrayLineas); // averigua la posicion que hay que borrar
    array_splice ( $arrayLineas , $posicion,1); // Elimina los datos de la posición que se le indica del array
    // var_dump($aux); // PRUEBAS
    // var_dump($arrayLineas); // PRUEBAS

    $archivo = fopen(PELISCSV, "w");
    // modifica archivo original
    foreach ($arrayLineas as $linea) {
        fputcsv($archivo,$linea,","); // escribe contenido nuevo
    }
    echo $mensaje;
    fclose($archivo);


}

// sobreescribirá los campos indicados y mostrará un mensaje al completar la acción.
function editar_pelicula($numid, $dato1, $dato2, $dato3, $nombreFichero){
    
    $archivo = fopen($nombreFichero, "r");
    $mensaje = "<div id='exito'>La pelicula ha sido guardada con éxito</div>";

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


    $posicion = buscarPosicion($numid, $arrayLineas); // averigua la posicion que hay que sobreescribir

    // reescribimos los datos en la posición del array auxiliar 
    $arrayLineas[$posicion][1]= $dato1;
    $arrayLineas[$posicion][2]= $dato2;
    $arrayLineas[$posicion][3]= $dato3;
    
    //var_dump($arrayLineas[$posicion]); // PUEBAS
    //chmod(PELISCSV, 0777);
    $archivo = fopen(PELISCSV, "w");
    // modifica archivo original
    foreach ($arrayLineas as $linea) {
        fputcsv($archivo,$linea,","); // escribe contenido nuevo
    }
    echo $mensaje;
    fclose($archivo);
    
}
function muestraFicha($posicion, $array){ // modificar los nombres de los li
    echo "<h4>FICHA DE LA PELÍCULA</h4>";
    echo "<ul>";
    echo "<li><strong>Título: </strong>".$array[$posicion][1]."</li>";
    echo "<li><strong>Año: </strong>".$array[$posicion][2]."</li>";
    echo "<li><strong>Duración: </strong>".$array[$posicion][3]."</li>";
    echo "</ul>";
}
// ESTOY POR AQUI: crear 2 funciones (trozo de arriba que se repite en borrar y editar y trozo de abajo)

?>