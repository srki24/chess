<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

class Rook extends AbstractPiece
{

    public function isValidMove(Field $fromField, Field $toField): bool
    {
        $sameCol = $fromField->getFile() == $toField->getFile();
        $sameRow = $fromField->getRank() == $toField->getRank();
        return $sameRow || $sameCol;
    }
}
