<?php
function getAspectRatio(int $width, int $height){
    $greatestCommonDivisor = static function($width, $height) use (&$greatestCommonDivisor) {
        return ($width % $height) ? $greatestCommonDivisor($height, $width % $height) : $height;
    };
    $divisor = $greatestCommonDivisor($width, $height);
    $aspectratio = $width / $divisor . ':' . $height / $divisor;

    return round( (($height / $divisor) / ($width / $divisor) * 100), 2 );
}

function itemformat($width, $height){
    if($width > $height){ return 'ls'; }
    else if($width < $height){ return 'pt'; }
    else if($width === $height){ return 'sq'; }
}