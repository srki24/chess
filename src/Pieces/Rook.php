<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

class Rook extends AbstractPiece
{

    public static function isValidMove(Field $fromField, Field $toField): bool
    {
        $sameCol = $fromField->getCol() == $toField->getCol();
        $sameRow = $fromField->getRow() == $toField->getRow();
        return $sameRow || $sameCol;
    }
}
