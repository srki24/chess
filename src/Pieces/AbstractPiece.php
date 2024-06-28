<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

abstract class AbstractPiece
{
    public function __construct(
        protected Color $color
    ) {
    }

    public function getColor(): Color
    {
        return $this->color;
    }
    abstract public static function isValidMove(field $fromField, Field $toField): bool;
}
