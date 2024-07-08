<?php

declare(strict_types=1);

namespace Chess\Pieces;

use Chess\Game\Field;

class Queen extends AbstractPiece
{

    private Bishop $bishop;
    private Rook $rook;

    public function __construct($color)
    {
        parent::__construct($color);
        $this->bishop = new Bishop($color);
        $this->rook  = new Rook($color);
    }

    public function isValidMove(Field $fromField, Field $toField): bool
    {
        return (
            $this->bishop->isValidMove($fromField, $toField)
            || $this->rook->isValidMove($fromField, $toField)
        );
    }

    public function attackingVectors(Field $fromField): array
    {
        return [];
    }
}
