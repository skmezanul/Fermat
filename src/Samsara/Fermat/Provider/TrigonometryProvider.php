<?php

namespace Samsara\Fermat\Provider;

use Samsara\Fermat\Numbers;

class TrigonometryProvider
{

    public static function radiansToDegrees($radians)
    {
        $radians = Numbers::makeOrDont(Numbers::IMMUTABLE, $radians);
        $pi = Numbers::makePi();
        
        return $radians->multiply(180)->divide($pi)->getValue();
    }

    public static function degreesToRadians($degrees)
    {
        $degrees = Numbers::makeOrDont(Numbers::IMMUTABLE, $degrees);
        $pi = Numbers::makePi();

        return $degrees->multiply($pi)->divide(180)->getValue();
    }

}