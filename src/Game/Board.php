<?php

declare(strict_types=1);

namespace Chess\Game;

use Chess\Game\Field;

define("BOARD_SIZE", 8);

class Board
{

    /**@var Field[] */
    public array $fields = [];

    public function __construct()
    {
        foreach (range(0, BOARD_SIZE-1) as $file) {
            foreach (range(0, BOARD_SIZE-1) as $rank) {
                $coords = Field::notationFromCoordinates($file, $rank);
                $this->fields[$coords] = new Field($coords);
            }
        }
    }

    public function getField(string $coords): Field
    {
        $coords = strtolower($coords);
        if (!array_key_exists($coords, $this->fields)) {
                throw new \Exception(("Unknown coordinates: ($coords)!"));
            }
        
            $field = $this->fields[$coords];
        return $field;

        }
        
    public function move(Field $fromField, Field $toField): void
    {
        if ($fromField->getNotation() === $toField->getNotation())
            throw new \Exception("A piece must move. You cannot skip a turn!");

        $piece = $fromField->getPiece();
        if (!$piece) {
            throw new \Exception("No piece found on this field!");
        };

        if (!$piece->isValidMove($fromField, $toField)) {
            throw new \Exception("Invald move");
        }

        $fromField->setPiece(null);
        $toField->setPiece($piece);
        $piece->hasMoved();
    }
}
