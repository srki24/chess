<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

class Knight extends AbstractPiece
{

    public static function isValidMove(Field $fromField, Field $toField): bool
    {

        $rowDelta = abs($fromField->getRow() - $toField->getRow());
        $colDelta = abs($fromField->getCol() - $toField->getCol());

        return ($rowDelta === 1 and $colDelta === 2) or ($rowDelta === 2 and $colDelta === 1);
    }
}
