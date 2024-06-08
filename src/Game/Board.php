<?php

declare(strict_types=1);

namespace Chess\Game;

define("DEFAULT_SIZE", 8);

class Board
{

    private array $fields;

    public function __construct(private int $size = DEFAULT_SIZE)
    {

        foreach (range(1, $size) as $row) {
            $this->fields[$row] = [];
            foreach (range(1, $size) as $col) {
                $this->fields[$row][$col] = new Field($row, $col, null);
            }
        }
    }

    public function getField(int $row, int $col): Field
    {
        return $this->fields[$row][$col];
    }

    public function move(Field $fromField, Field $toField): void
    {
        if (!$this->isExistingField($fromField))
            throw new \Exception("From $fromField doesn't exist!");

        if (!$this->isExistingField($toField))
            throw new \Exception("To $toField doesn't exist!");


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

    public function isExistingField(Field $field): bool
    {
        $row = $field->getRow();
        $col = $field->getCol();

        return ($row > 0 && $row <= $this->size) &&
            ($col > 0 && $col <= $this->size);
    }
}
