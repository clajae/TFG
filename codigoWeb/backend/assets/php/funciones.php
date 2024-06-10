<?php
function is_valid_dni(string $dni): bool
{
    $letter = substr($dni, -1);
    $numbers = substr($dni, 0, -1);
    $patron = "/[0-9]{7,8}[A-Z]/";
    if (preg_match($patron, $dni) && substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers % 23, 1) == $letter && strlen($letter) == 1 ) {
        return true;
    }
    return false;
}

function is_valid_cif(string $cif): bool
{
    $letter = substr($cif, -1);
    $digits = substr($cif, 0, -1);
    $pattern = "/^[ABCDEFGHJKLMNPQRSUVW][0-9]{7}[0-9A-J]$/";

    if (preg_match($pattern, $cif) && strlen($letter) == 1) {
        $sum = 0;
        for ($i = 0; $i < 7; $i++) {
            $digit = $digits[$i];
            if ($i % 2 == 0) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $sum += $digit;
        }

        $sum = (int) substr($sum, -1);
        $checksum = (10 - $sum) % 10;

        if (($letter >= 'A' && $letter <= 'J') || $letter == (string) $checksum) {
            return true;
        }
    }

    return false;
}

function is_valid_phone(string $telefono): bool 
{
    $patron = "/^(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}$/";
    if (preg_match($patron, $telefono)) {
        return true;
    } 
    return false;
}

function is_valid_password(string $password_key): bool 
{
    $patron = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{1,10}$/";
    if (preg_match($patron, $password_key)) {
        return true;
    } 
    return false;
}

function HayNulos(array $camposNoNulos, array $arrayDatos): array
{
    $nulos = [];
    foreach ($camposNoNulos as $index => $campo) {
        if (!isset($arrayDatos[$campo]) || empty($arrayDatos[$campo]) || $arrayDatos[$campo] == null) {
            $nulos[] = $campo;
        }
    }
    return $nulos;
}

function existeValor(array $array, string $campo, mixed $valor): bool
{
        return in_array ($array[$campo],$valor);

}

function DibujarErrores($errores, $campo)
{
    $cadena = "";
    if (isset($errores[$campo])) {
        $last = end($errores);
        foreach ($errores[$campo] as $indice => $msgError) {
            $salto = ($errores[$campo] == $last) ? "" : "<br>";
            $cadena .= "{$msgError}.{$salto}";
        }
    }
    return $cadena;
}

function is_valid_email($str)
{
    return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));
}

function fechaEs($fecha) 
{
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
