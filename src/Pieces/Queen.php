<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

class Queen extends AbstractPiece
{

    public function isValidMove(Field $fromField, Field $toField): bool
    {
        return (
            (new Bishop($this->getColor()))->isValidMove($fromField, $toField) || (new Rook($this->getColor()))->isValidMove($fromField, $toField));
    }
}
