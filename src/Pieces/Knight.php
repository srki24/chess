<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Board;
use Chess\Game\Field;

class Knight extends AbstractPiece
{

    public function isValidMove(Field $fromField, Field $toField): bool
    {

        $rankDelta = abs($fromField->getRank() - $toField->getRank());
        $fileDelta = abs($fromField->getFile() - $toField->getFile());

        return ($rankDelta === 1 and $fileDelta === 2) or ($rankDelta === 2 and $fileDelta === 1);
    }

    public function attackingVectors(Field $fromField): array
    {
        $rank = $fromField->getRank();
        $file = $fromField->getFile();

        $deltas = [
            [-2, -1],
            [-2, +1],
            [+2, -1],
            [+2, +1],
            [-1, -2],
            [-1, +2],
            [+1, -2],
            [+1, +2]
        ];
        $attackingFields = [];

        foreach ($deltas as $delta) {
            $attckRank = $rank + $delta[0];
            $attckFile = $file + $delta[1];

            if (
                $attckRank >= 0
                && $attckFile >= 0
                && $attckRank < Board::SIZE
                && $attckFile < BOARD::SIZE
            ) {
                array_push($attackingFields, [Field::notationFromCoordinates($attckFile, $attckRank)]);
            }
        }
        return $attackingFields;
    }
}
