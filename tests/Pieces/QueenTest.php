<?php

declare(strict_types=1);

use Chess\Game\Field;
use Chess\Pieces\Queen;
use Chess\Pieces\Rook;
use Chess\Pieces\Bishop;
use Chess\Pieces\Color;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(Queen::class)]
#[UsesClass(Field::class)]
#[UsesClass(Bishop::class)]
#[UsesClass(Rook::class)]
final class QueenTest extends TestCase
{
    public function testCreatePiece()
    {
        $piece = new Queen(Color::BLACK);
        $this->assertSame($piece->getColor(), Color::BLACK);

        $piece = new Queen(Color::WHITE);
        $this->assertSame($piece->getColor(), Color::WHITE);
    }


    #[DataProvider('moveProvider')]
    public function testMove(
        bool $expected,
        Field $fromField,
        Field $toField
    ): void {

        $this->assertSame(
            $expected,
            Queen::isValidMove($fromField, $toField)
        );
    }

    public static function moveProvider()
    {
        return [
            'B a1-d4 (valid)' => [true,  new Field('a1'),  new Field('d4')],
            'B a1-a5 (valid)' => [true,  new Field('a1'),  new Field('a5')],
            'B d2-c1 (valid)' => [true,  new Field('d2'),  new Field('c1')],
            'B d2-d5 (valid)' => [true,  new Field('d2'),  new Field('d5')],
            'B h5-d1 (valid)' => [true,  new Field('h5'),  new Field('d1')],
            'B h5-f5 (valid)' => [true,  new Field('h5'),  new Field('f5')],
            'B g7-h8 (valid)' => [true,  new Field('g7'),  new Field('h8')],
            'B g7-b7 (valid)' => [true,  new Field('g7'),  new Field('b7')],

            'B a1-g2 (invalid)' => [false, new Field('a1'), new Field('g2')],
            'B a1-a2 (invalid)' => [false, new Field('a1'), new Field('b4')],
            'B d2-g3 (invalid)' => [false, new Field('d2'), new Field('g3')],
            'B d2-a7 (invalid)' => [false, new Field('d2'), new Field('a7')],
            'B h5-f4 (invalid)' => [false, new Field('h5'), new Field('f4')],
            'B h5-g3 (invalid)' => [false, new Field('h5'), new Field('g3')],
            'B g7-c2 (invalid)' => [false, new Field('g7'), new Field('c2')],
            'B g7-a2 (invalid)' => [false, new Field('g7'), new Field('a2')],
        ];
    }
}
