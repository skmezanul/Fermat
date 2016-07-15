<?php

namespace Samsara\Fermat\Provider\Stats\Distribution;

use Samsara\Fermat\Numbers;
use Samsara\Fermat\Provider\Stats\Stats;
use Samsara\Fermat\Values\Base\NumberInterface;

class Normal
{

    /**
     * @var NumberInterface
     */
    private $mean;

    /**
     * @var NumberInterface
     */
    private $sd;

    public function __construct($mean, $sd)
    {
        $mean = Numbers::makeOrDont(Numbers::IMMUTABLE, $mean);
        $sd = Numbers::makeOrDont(Numbers::IMMUTABLE, $sd);

        $this->mean = $mean;
        $this->sd = $sd;
    }

    public static function makeFromMean($p, $x, $mean)
    {
        $one = Numbers::makeOne();
        $p = Numbers::makeOrDont(Numbers::IMMUTABLE, $p);
        $x = Numbers::makeOrDont(Numbers::IMMUTABLE, $x);
        $mean = Numbers::makeOrDont(Numbers::IMMUTABLE, $mean);

        $z = Stats::inverseNormalCDF($one->subtract($p));

        $sd = $x->subtract($mean)->divide($z);

        return new Normal($mean, $sd);
    }

    public static function makeFromSd($p, $x, $sd)
    {
        $one = Numbers::makeOne();
        $p = Numbers::makeOrDont(Numbers::IMMUTABLE, $p);
        $x = Numbers::makeOrDont(Numbers::IMMUTABLE, $x);
        $sd = Numbers::makeOrDont(Numbers::IMMUTABLE, $sd);

        $z = Stats::inverseNormalCDF($one->subtract($p));

        $mean = $x->subtract($z->multiply($sd));

        return new Normal($mean, $sd);
    }

}