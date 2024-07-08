<?php

declare(strict_types=1);

namespace Chess\Game;

use Chess\Pieces\AbstractPiece;

class Field
{
    private int $file;
    private int $rank;

    public function __construct(
        private string $notation,
        private ?AbstractPiece $piece = null
    ) {
        $coordinates = Field::coordinatesFromNotation($notation);
        $this->file = $coordinates['file'];
        $this->rank = $coordinates['rank'];
    }

    public static function coordinatesFromNotation(string $coordinates): array
    {
        $coordinates = strtolower($coordinates);

        if (strlen($coordinates) < 2) {
            throw new \Exception("Invalid format of the coordinates: $coordinates.");
        }

        if (!ctype_alpha($coordinates[0])) {
            throw new \Exception("File must be a string: $coordinates");
        }

        if (!ctype_digit(substr($coordinates, 1))) {
            throw new \Exception("Rank must be a number: $coordinates");
        }

        $file = ord($coordinates[0]) - ord("a");
        $rank = ord($coordinates[1]) - ord("1");
        return [
            'file' => $file,
            'rank' => $rank
        ];
    }

    public static function notationFromCoordinates(int $file, int $rank): string
    {
        $fileCoord = chr($file + ord("a"));
        $rankCoord = chr($rank + ord("1"));
        return $fileCoord . $rankCoord;
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function getFile(): int
    {
        return $this->file;
    }

    public function getNotation(): string
    {
        return $this->notation;
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

    public function isOccupied(): bool
    {
        return !is_null($this->piece);
    }
}
