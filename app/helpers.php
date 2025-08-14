<?php

function formatomoneda($cadena) {
    // Carácter que se desea buscar
    $caracter = '.';

    // Buscar el carácter en la cadena
    $posicion = strpos($cadena, $caracter);

    // Obtener la subcadena a partir del carácter especificado
    $subcadena = substr($cadena, strpos($cadena, $caracter)+1);

    // Contar los caracteres de la subcadena
    $numCaracteres = strlen($subcadena);

    // Verificar si se encontró el carácter
    if ($posicion !== false)
    {
        $importe = number_format($cadena, $numCaracteres, '.', ',');
    } 
    else
    {
        $importe = number_format($cadena, 3, '.', ',');
    }

    return $importe;
}

function formatonumero($cadena) {
    // Carácter que se desea buscar
    $caracter = '.';

    // Buscar el carácter en la cadena
    $posicion = strpos($cadena, $caracter);

    // Obtener la subcadena a partir del carácter especificado
    $subcadena = substr($cadena, strpos($cadena, $caracter)+1);

    // Contar los caracteres de la subcadena
    $numCaracteres = strlen($subcadena);

    // Verificar si se encontró el carácter
    if ($posicion !== false)
    {
        $importe = number_format($cadena, $numCaracteres, '.', ',');
    } 
    else
    {
        $importe = number_format($cadena, 0, '.', ',');
    }

    return $importe;
}

function formatBytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    $bytes /= pow(1024, $pow);

    return round($bytes, $precision) . ' ' . $units[$pow];
}