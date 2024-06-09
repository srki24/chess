<?php

declare(strict_types=1);

namespace Chess\Game;

use Chess\Game\Field;

define("DEFAULT_SIZE", 8);

class Board
{

    /**@var Field[] */
    public array $fields = [];

    public function __construct(private int $size = DEFAULT_SIZE)
    {

        foreach (range(1, $size) as $row) {
            $rank = $row;

            foreach (range(1, $size) as $col) {
                $file = chr((int)($col - 1 + ord("A")));
                $coords = $file . $rank;
                array_push($this->fields, new Field($coords));
            }
        }
    }

    public function getField(string $coords): Field
    {

        $field = array_filter($this->fields, function ($field) use ($coords) {
            return ($field->getCoordinates() == $coords);
        });

        if (!$field) {
            throw new \Exception(("Unknown field coordinates ($coords)!"));
        }
        return array_pop($field);
    }

    public function move(Field $fromField, Field $toField): void
    {

        $piece = $fromField->getPiece();
        if (!$piece) {
            throw new \Exception("No piece found on this field!");
        };

        if (!$piece->isValidMove($fromField, $toField)) {
            throw new \Exception("Invald move");
        }

        $fromField->setPiece(null);
        $toField->setPiece($piece);
    }
}
