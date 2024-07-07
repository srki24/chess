<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

class Knight extends AbstractPiece
{

    public function isValidMove(Field $fromField, Field $toField): bool
    {

        $rankDelta = abs($fromField->getRank() - $toField->getRank());
        $fileDelta = abs($fromField->getFile() - $toField->getFile());

        return ($rankDelta === 1 and $fileDelta === 2) or ($rankDelta === 2 and $fileDelta === 1);
    }

    public function attacks(Field $fromField): array
    {
        $rank = $fromField->getRank();
        $file = $fromField->getFile();
        return [];
    }
}
