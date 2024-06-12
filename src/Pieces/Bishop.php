<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

class Bishop extends AbstractPiece
{

    public static function isValidMove(Field $fromField, Field $toField): bool
    {

        $rowDelta = abs($fromField->getRank() - $toField->getRank());
        $colDelta = abs($fromField->getFile() - $toField->getFile());

        return ($rowDelta ===  $colDelta );
    }
}
