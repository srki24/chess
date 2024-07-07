<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

abstract class AbstractPiece
{
    protected bool $isInitialPosition = True;

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

    public function hasMoved(): void
    {
        $this->isInitialPosition = False;
    }
    
    /**
     * @return array[string[]]
     */
    // abstract public function attacks(Field $fromField): array;

    abstract public function isValidMove(Field $fromField, Field $toField): bool;
}
