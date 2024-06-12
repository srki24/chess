<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

class Queen extends AbstractPiece
{

    public static function isValidMove(Field $fromField, Field $toField): bool
    {
        return (Bishop::isValidMove($fromField, $toField) || Rook::isValidMove($fromField, $toField));
        
    }
}
