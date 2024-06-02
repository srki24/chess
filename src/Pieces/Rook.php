<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

class Rook extends AbstractPiece
{

    public function isValidMove(Field $fromField, Field $toField): bool
    {
        return true;
    }
}
