<?php

declare(strict_types=1);


use Chess\Game\Field;
use Chess\Pieces\Pawn;
use Chess\Pieces\Color;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(Pawn::class)]
#[UsesClass(Field::class)]

final class PawnTest extends TestCase
{

    private Pawn $whitePawn;
    private Pawn $blackPawn;


    protected function setUp(): void
    {
        $this->whitePawn = new Pawn(Color::WHITE);
        $this->blackPawn = new Pawn(Color::BLACK);
    }

    public function testGetColor()
    {
        $this->assertSame($this->whitePawn->getColor(), Color::WHITE);
        $this->assertSame($this->blackPawn->getColor(), Color::BLACK);
    }


    #[DataProvider('invalidMoveProvider')]
    #[DataProvider('validMoveProvider')]
    public function testWhiteMove(
        bool $expected,
        Field $fromField,
        Field $toField
    ): void {

        $this->assertSame(
            $expected,
            $fromField->getPiece()->isValidMove($fromField, $toField)
        );
        // var_dump($this->whitePawn->hasMoved);
    }

    public static function validMoveProvider()
    {
        $whitePawn = new Pawn(Color::WHITE);
        $blackPawn = new Pawn(Color::BLACK);

        return [
            'P b2-b3 (valid)' => [true, new Field('b2', $whitePawn), new Field('b3')],
            'P b2-a3 (valid)' => [true, new Field('b2', $whitePawn), new Field('a3', $blackPawn)],
            'P b2-c3 (valid)' => [true, new Field('b2', $whitePawn), new Field('c3')],
            'P d2-d4 (valid)' => [true, new Field('d2', $whitePawn), new Field('d4')],
            'P h5-h6 (valid)' => [true, new Field('h5', $whitePawn), new Field('h6')],
            'P h6-g7 (valid)' => [true, new Field('h6', $whitePawn), new Field('g7')],
            'P g7-g8 (valid)' => [true, new Field('g7', $whitePawn), new Field('g8')],
            'P g2-g4 (valid)' => [true, new Field('g2', $whitePawn), new Field('g4')],
        ];
    }
    public static function invalidMoveProvider()
    {
        $whitePawn = new Pawn(Color::WHITE);
        $whitePawn->hasMoved();

        $blackPawn = new Pawn(Color::BLACK);
        $blackPawn->hasMoved();

        return [
            'P a3-a5 (invalid)' => [false, new Field('a3', $whitePawn), new Field('a5')],
            'P b2-b1 (invalid)' => [false, new Field('b2', $whitePawn), new Field('b1')],
            'P b2-a1 (invalid)' => [false, new Field('b2', $whitePawn), new Field('a1')],
            'P e4-d4 (invalid)' => [false, new Field('e4', $whitePawn), new Field('d4')],
            'P e4-f4 (invalid)' => [false, new Field('e4', $whitePawn), new Field('f4')],
            'P h5-f3 (invalid)' => [false, new Field('h5', $whitePawn), new Field('f3')],
            'P h5-h7 (invalid)' => [false, new Field('h5', $whitePawn), new Field('h7')],
            'P h5-f7 (invalid)' => [false, new Field('h5', $whitePawn), new Field('f7')],
        ];

    }
}
