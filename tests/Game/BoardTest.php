<?php

declare(strict_types=1);

use Chess\Game\Board;
use Chess\Game\Field;
use Chess\Pieces\Rook;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class BoardTest extends TestCase
{

    public function testThrowWhenEmptyField(): void
    {
        $b = new Board(); // Empty board
        $this->expectException(\Exception::class);
        $b->move(
            $b->getField(1, 1),
            $b->getField(2, 2)
        );
    }

    public function testValidMove(): void
    {
        $b = new Board(); // Empty Board

        $piece = new Rook(color: 'WHITE');

        $fromField = $b->getField(1, 1);
        $fromField->setPiece($piece);

        $toField = $b->getField(1, 2);
        $b->move($fromField, $toField);

        // Original field empty
        $this->assertNull($fromField->getPiece());

        // Piece moved to the target field
        $this->assertSame($piece, $toField->getPiece());
    }

    #[DataProvider('existingFieldProvider')]
    public function testIsExistingField(
        bool $expected,
        int $boardSize,
        Field $field
    ): void {
        $b = new Board($boardSize);
        $this->assertSame(
            $expected,
            $b->isExistingField($field)
        );
    }

    public static function existingFieldProvider()
    {
        return [
            't1' => [true,  8,  new Field(5, 5)],
            't2' => [true,  8,  new Field(8, 8)],
            't3' => [true,  3,  new Field(1, 1)],
            't4' => [true,  20, new Field(15, 15)],
            'f1' => [false, 8,  new Field(0, 0)],
            'f2' => [false, 8,  new Field(9, 9)],
            'f3' => [false, 3,  new Field(4, 4)],
            'f4' => [false,  20, new Field(22, 22)],
        ];
    }
}
