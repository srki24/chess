<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

class Knight extends AbstractPiece
{

    public function isValidMove(Field $fromField, Field $toField): bool
    {

        $rowDelta = abs($fromField->getRank() - $toField->getRank());
        $colDelta = abs($fromField->getFile() - $toField->getFile());

        return ($rowDelta === 1 and $colDelta === 2) or ($rowDelta === 2 and $colDelta === 1);
    }
}
