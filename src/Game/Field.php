<?php

declare(strict_types=1);

namespace Chess\Game;

use Chess\Pieces\AbstractPiece;

class Field
{
    public function __construct(
        private int $row,
        private int $col,
        private ?AbstractPiece $piece = null
    ) {
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function getCol(): int
    {
        return $this->col;
    }

    public function getPiece(): ?AbstractPiece
    {
        return $this->piece;
    }

    public function setPiece(?AbstractPiece $piece): ?AbstractPiece
    {
        $this->piece = $piece;
        return $piece;
    }

    public function __toString(): string
    {
        //TODO add string rep for piece
        return  "Field (row=$this->row) (col=$this->col)";
    }
}
