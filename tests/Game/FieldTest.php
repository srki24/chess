<?php

declare(strict_types=1);

use Chess\Game\Field;
use Chess\Pieces\AbstractPiece;
use Chess\Pieces\Bishop;
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
#[UsesClass(Field::class)]
final class FieldTest extends TestCase
{

    public function testCoordinates(){
        // given
        $coordinates = 'a5';
        $file = 0;
        $rank = 4;

        $field = new Field($coordinates);

        // then
        $this->assertSame(
            $field->getCoordinates(),
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

    public function testSetPiece()
    {
        // given
        $piece = new Bishop('WHITE');

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
        string $coordinates,
        ?AbstractPiece $piece = null
    ) {

        $field = new Field(
            coordinates: $coordinates,
            piece: $piece
        );

        $this->assertSame($field->getCoordinates(), $coordinates);
        $this->assertSame($field->getPiece(), $piece);
    }

    public static function validFieldProvider()
    {
        return [
            'Field(b12)'        => ['b12'],
            'Field(c24)'        => ['c24'],
            'Field(d15)'        => ['d15'],
            'Field(a1, Knight)' => ['a1', new Knight('WHITE')],
            'Field(d5, Rook)'   => ['d5', new Rook('WHITE')],
            'Field(d5, Bishop)' => ['d5', new Bishop('BLACK')],
        ];
    }

    #[DataProvider('invalidFieldProvider')]
    public function testInvalidField(
        string $coordinates,
        ?AbstractPiece $piece = null
    ) {
        $this->expectException(\Exception::class);
        $field = new Field(
            coordinates: $coordinates,
            piece: $piece
        );
    }

    public static function invalidFieldProvider()
    {
        return [
            'Field("") empty string' => [''],
            'Field(11)'              => ['11'],
            'Field(ab)'              => ['ab'],
            'Field(a1\n)'            => ['a1\n'],
            'Field(1a)'              => ['1a'],
        ];
    }
}
