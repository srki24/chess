<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

class Knight extends AbstractPiece
{

    public static function isValidMove(Field $fromField, Field $toField): bool
    {
        $fromCol = $fromField->getCol();
        $fromRow = $fromField->getRow();
        
        $validMoves = [
            [ $fromRow + 2, $fromCol +1],
            [ $fromRow + 2, $fromCol -1],
            [ $fromRow - 2, $fromCol +1],
            [ $fromRow - 2, $fromCol -1],
            [ $fromRow + 1, $fromCol + 2],
            [ $fromRow + 1, $fromCol - 2],
            [ $fromRow - 1, $fromCol + 2],
            [ $fromRow - 1, $fromCol - 2]
        ];
        return in_array([$toField->getRow(), $toField->getCol()], $validMoves);
    }
}
