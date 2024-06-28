<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

class Pawn extends AbstractPiece
{

    public function isValidMove(Field $fromField, Field $toField): bool
    {
        return false;
    }
}
