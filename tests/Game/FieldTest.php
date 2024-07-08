<?php

declare(strict_types=1);

use Chess\Game\Field;
use Chess\Pieces\AbstractPiece;
use Chess\Pieces\Bishop;
use Chess\Pieces\Color;
use Chess\Pieces\Knight;
use Chess\Pieces\Rook;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(Field::class)]
#[UsesClass(Bishop::class)]
#[UsesClass(Knight::class)]
#[UsesClass(Rook::class)]
final class FieldTest extends TestCase
{

    public function testCoordinates()
    {
        // given
        $coordinates = 'a5';
        $file = 0;
        $rank = 4;

        $field = new Field($coordinates);

        // then
        $this->assertSame(
            $field->getNotation(),
            $coordinates
        );

        $this->assertSame(
            $field->getFile(),
            $file
        );

        $this->assertSame(
            $field->getRank(),
            $rank
        );
    }

    public function testIsOccupied()
    {
        $field = new Field('a1');
        $this->assertFalse($field->isOccupied());

        $field->setPiece(new Knight(Color::WHITE));
        $this->assertTrue($field->isOccupied());
    }
    public function testSetPiece()
    {
        // given
        $piece = new Bishop(Color::BLACK);

        // when
        $field = new Field('a5');
        // then
        $this->assertNull($field->getPiece());

        // when
        $field->setPiece($piece);
        // then
        $this->assertSame($piece, $field->getPiece());

        // when
        $field->setPiece(null);
        // then
        $this->assertNull($field->getPiece());
    }

    #[DataProvider('validFieldProvider')]
    public function testValidField(
        string $notation,
        ?AbstractPiece $piece = null
    ) {

        $field = new Field(
            notation: $notation,
            piece: $piece
        );

        $this->assertSame($field->getNotation(), $notation);
        $this->assertSame($field->getPiece(), $piece);
    }

    public static function validFieldProvider()
    {
        return [
            'Field(b12)'        => ['b12'],
            'Field(c24)'        => ['c24'],
            'Field(d15)'        => ['d15'],
            'Field(a1, Knight)' => ['a1', new Knight(Color::BLACK)],
            'Field(d5, Rook)'   => ['d5', new Rook(Color::WHITE)],
            'Field(d5, Bishop)' => ['d5', new Bishop(Color::BLACK)],
        ];
    }

    #[DataProvider('invalidNotationProvider')]
    public function testThworInvalidField(
        string $notation,
        ?AbstractPiece $piece = null
    ) {
        $this->expectException(\Exception::class);
        $field = new Field(
            notation: $notation,
            piece: $piece
        );
    }

    public static function invalidNotationProvider()
    {
        return [
            'Field("") empty string' => [''],
            'Field(11)'              => ['11'],
            'Field(ab)'              => ['ab'],
            'Field(a1\n)'            => ['a1\n'],
            'Field(1a)'              => ['1a'],
        ];
    }

    #[DataProvider('notationProvider')]
    public function testNotationFromCoordinates(
        string $notation,
        int $file,
        int $rank
    ) {

        $generatedNotation = Field::notationFromCoordinates($file, $rank);
        $this->assertSame($generatedNotation, $notation);
    }


    #[DataProvider('notationProvider')]
    public function testCoordinatesFromNotation(
        string $notation,
        int $file,
        int $rank
    ) {

        $coords = Field::coordinatesFromNotation($notation);

        $this->assertSame($file, $coords['file']);
        $this->assertSame($rank, $coords['rank']);
    }

    public static function notationProvider()
    {
        return [
            'Field(a1)' => ['a1', 0, 0],
            'Field(b3)' => ['b3', 1, 2],
            'Field(c4)' => ['c4', 2, 3],
            'Field(d5)' => ['d5', 3, 4],
            'Field(h8)' => ['h8', 7, 7],
        ];
    }
}
