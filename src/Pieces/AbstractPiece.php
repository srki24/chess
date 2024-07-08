<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

abstract class AbstractPiece
{
    public bool $hasMoved = False;

    public function __construct(
        protected Color $color
    ) {
    }

    public function isEnemy(Color $color): bool
    {
        return $this->color != $color;
    }

    public function getColor(): Color
    {
        return $this->color;
    }

    public function markMoved(): void
    {
        $this->hasMoved = True;
    }
    
    public function hasMoved(): bool
    {
        return $this->hasMoved;
    }
    /**
     * @return array[string[]]
     */
    abstract public function attackingVectors(Field $fromField): array;

    abstract public function isValidMove(Field $fromField, Field $toField): bool;
}
