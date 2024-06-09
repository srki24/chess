<?php

declare(strict_types=1);

namespace Chess\Game;

use Chess\Pieces\AbstractPiece;

class Field
{
    private int $row;
    private int $col;

    public function __construct(
        private string $coordinates,
        private ?AbstractPiece $piece = null
    ) {
        $coordinates = strtoupper($coordinates);

        if (strlen($coordinates) < 2) {
            throw new \Exception("Invalid format of the coordinates: $coordinates.");
        }

        if (!ctype_alpha($coordinates[0])) {
            throw new \Exception("Field file must be a string: $coordinates");
        }

        if (!ctype_digit(substr($coordinates, 1))) {
            throw new \Exception("Field rank must be a number: $coordinates");
        }

        $this->row = intval(substr($coordinates, 1));
        $this->col = 1 + ord($coordinates[0]) - ord("A");
    }

    public function getRow(): int
    {
        return $this->row;
    }

    public function getCol(): int
    {
        return $this->col;
    }

    public function getCoordinates(): string
    {
        return $this->coordinates;
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
