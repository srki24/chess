<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;


class Pawn extends AbstractPiece
{



    public function isValidMove(Field $fromField, Field $toField): bool
    {

        $fileDelta = abs($fromField->getFile() - $toField->getFile());
        $rankDelta = $fromField->getRank() - $toField->getRank();

        if ($this->getColor() == Color::WHITE) {
            $rankDelta = -$rankDelta;
        }
        // Advance single square
        if ($rankDelta == 1 and $fileDelta == 0) {
            return true;
        }
        // Advance two squares
        if ($rankDelta === 2 and $fileDelta === 0 and $this->isInitialPosition) {
            return true;
        }

        // Diagonal attack
        if ($rankDelta == 1 and $fileDelta == 1) {
            $targetPieceColor = $toField->getPiece()?->getColor();
            if ($targetPieceColor != $this->color) {
                return true;
            }
        }

        return false;
    }
}
