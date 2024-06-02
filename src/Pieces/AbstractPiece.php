<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

abstract class AbstractPiece
{
    public function __construct(
        private string $color
    ) {
    }

    public function getColor(): string
    {
        return $this->color;
    }
    abstract public function isValidMove(field $fromField, Field $toField): bool;
}
