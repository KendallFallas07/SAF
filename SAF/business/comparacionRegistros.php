<?php

function porcentajeIncidencia(string $palabraEntrada, string $palabraBD, bool $debug) {
    //se pasa a minusculas
    $palabraEntradaNomalizada = strtolower($palabraEntrada);
    $palabraBDNormalizada = strtolower($palabraBD);
    //se sacan las longitudes
    $numeroLetrasEntrdata = strlen($palabraEntradaNomalizada);
    $numeroLetrasBD = strlen($palabraBDNormalizada);
    //debug
    if ($debug) {
        echo "Las palabra normalizadas son: $palabraEntradaNomalizada y $palabraBDNormalizada";
        //debug
        echo "<br> el numero de letras en la palabra de entrada es: $numeroLetrasEntrdata";
        echo "<br> el numero de letras en la palabra de bd es:  $numeroLetrasBD";
    }
    if ($numeroLetrasEntrdata > $numeroLetrasBD) {
        $result = 0;
        for ($index = 0; $index < $numeroLetrasBD; $index++) {
            if ($palabraEntradaNomalizada[$index] == $palabraBDNormalizada[$index]) {
                $result++;
            }
        }
        //debug
        if ($debug) {
            echo "<br> la palabra de entrada es de mayor longitud";
            echo "<br> Los valores de coincidencia: $result";
            echo "<br> el resultado de probabilidad es de que sea la misma palabra es :";
            echo $result / $numeroLetrasBD;
        }
        return $result / $numeroLetrasBD;
    } elseif ($numeroLetrasEntrdata < $numeroLetrasBD) {
        $result = 0;
        for ($index = 0; $index < $numeroLetrasEntrdata; $index++) {
            if ($palabraEntradaNomalizada[$index] == $palabraBDNormalizada[$index]) {
                $result++;
            }
        }
        //debug
        if ($debug) {
            echo "<br> la palabra en BD es de mayor longitud";
            echo "<br> Los valores de coincidencia: $result";
            echo "<br> el resultado de probabilidad es de que sea la misma palabra es :";
            echo $result / $numeroLetrasBD;
        }
        return $result / $numeroLetrasBD;
    } else {
        $result = 0;
        for ($index = 0; $index < $numeroLetrasBD; $index++) {
            if ($palabraEntradaNomalizada[$index] == $palabraBDNormalizada[$index]) {
                $result++;
            }
        }
        //debug
        if ($debug) {
            echo "<br> la palabras son de igual longitud";
            echo "<br> Los valores de coincidencia: $result";
            echo "<br> el resultado de probabilidad es de que sea la misma palabra es :";
            echo $result / $numeroLetrasBD;
        }
        return $result / $numeroLetrasBD;
    }
}
