<?php

namespace Refactoring\usuarios\Transport;

use Refactoring\Price;
class AirPlane extends Type
{
    public function obtainPrice($peopleToTravel)
    {
        return $peopleToTravel * 100;
    }
}