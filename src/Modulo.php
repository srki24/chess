<?php

declare(strict_types=1);

namespace Chess;

class Modulo
{

    public static function isModulo($value, $modBy = 2): bool
    {
        if (!is_numeric($value) |  !is_numeric($modBy)) {
            throw new \Exception(("Parameter type must be numeric!"));
        }

        return $value % $modBy == 0;
    }
}
