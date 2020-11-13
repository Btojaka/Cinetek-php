<?php
// lee el fichero peliculas.csv
function get_dataMovies($nombreFichero){
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

// function asociar($nom_arrayLineas){
//     $pelisAsocia = null;
//     for ($i=0 ; $i < count($nom_arrayLineas) ; $i++) {
//         echo "<br>";
//         for ($j=0; $j < count($array[$i]); $j++) {
//             $pelisAsocia['ID'] = $arrayLineas[$i][0];
//             $pelisAsocia['Nombre'] = $arrayLineas[$i][1];

//             echo $array[$i][$j]."</br>";
//         }
//         echo "<br>";
//     }

// }
?>