<?php

declare(strict_types=1);

namespace Chess\Game;

use Chess\Pieces\AbstractPiece;

class Field
{
    private int $file;
    private int $rank;

    public function __construct(
        private string $coordinates,
        private ?AbstractPiece $piece = null
    ) {
        $coordinates = strtolower($coordinates);

        if (strlen($coordinates) < 2) {
            throw new \Exception("Invalid format of the coordinates: $coordinates.");
        }

        if (!ctype_alpha($coordinates[0])) {
            throw new \Exception("Field file must be a string: $coordinates");
        }

        if (!ctype_digit(substr($coordinates, 1))) {
            throw new \Exception("Field rank must be a number: $coordinates");
        }

        $this->file = ord($coordinates[0]) - ord("a");
        $this->rank = intval(substr($coordinates, 1)) - 1;
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function getFile(): int
    {
        return $this->file;
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
}
