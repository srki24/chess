<?php

declare(strict_types=1);

namespace Chess\Game;

use Chess\Pieces\Rook;

class Board
{

    public array $fields;

    public function __construct(private int $size = 8)
    {

        foreach (range(1, $size) as $row) {
            $this->fields[$row] = [];
            foreach (range(1, $size) as $col) {
                $this->fields[$row][$col] = new Field($row, $row, null);
            }
        }
    }
    
    public function getField(int $row, int $col): Field
    {
        return $this->fields[$row][$col];
    }
    
    public function move(Field $fromField, Field $toField)
    {
        $piece = $fromField->getPiece();
        if (!$piece) {
            throw new \Exception("No piece found on this field!");
        };

        if(!$piece->isValidMove($fromField, $toField))
        {
            throw new \Exception("Invald move");
        }

        $fromField->setPiece(null);
        $toField->setPiece($piece);
    }

}
