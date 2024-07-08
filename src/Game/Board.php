<?php

declare(strict_types=1);

namespace Chess\Game;

use Chess\Game\Field;
use Chess\Pieces\AbstractPiece;

class Board
{
    const SIZE = 8;
    /**@var Field[] */
    public array $fields = [];

    public function __construct()
    {
        foreach (range(0, self::SIZE - 1) as $file) {
            foreach (range(0, self::SIZE - 1) as $rank) {
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

        if (!$this->canMove($piece, $fromField, $toField)) {
            throw new \Exception("Invald move");
        }


        $fromField->setPiece(null);
        $toField->setPiece($piece);
        $piece->markMoved();
    }

    public function canMove(AbstractPiece $piece, Field $fromField, Field $toField): bool
    {
        if (!$piece->isValidMove($fromField, $toField)) {
            return false;
        }

        $vector = array_filter(
            $piece->attackingVectors($fromField),
            function (array $vec) use ($toField) {
                return in_array($toField->getNotation(), $vec);
            }
        );
        $notations = array_pop($vector);
        if(!$notations)
        {
            $notations = [];
        }

        // Assumes that notations are sorted by proximity 
        foreach ($notations as $note) {
            $field = $this->getField($note);

            if ($field === $toField) {

                if ($field->isOccupied()); {
                    $targetPiece = $field->getPiece();
                    if (!$piece->isEnemy($targetPiece->getColor())) {
                        return false;
                    }
                }
                return true;
            }

            if ($field->isOccupied()) {
                return false;
            }
        }
        return true;
    }
}
