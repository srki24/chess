<?php

declare(strict_types=1);

use Chess\Game\Board;
use Chess\Game\Field;
use Chess\Pieces\Rook;
use Chess\Pieces\Color;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(Board::class)]
#[UsesClass(Field::class)]
#[UsesClass(Rook::class)]
#[UsesClass(Color::class)]
final class BoardTest extends TestCase
{

    private $board;
    private $rook;
    protected function setUp(): void
    {
        $this->board = new Board();
        $this->rook = new Rook(Color::WHITE);
    }

    public function testMoveThrowWhenMoveFromEmptyField(): void
    {
        $this->expectException(\Exception::class);
        $this->board->move(
            fromField: $this->board->getField('a1'),
            toField: $this->board->getField('a2')
        );
    }

    public function testMoveThrowWhenSameField(): void
    {
        $this->board->getField('a1')->setPiece($this->rook);

        $this->expectException(\Exception::class);
        $this->board->move(
            fromField: $this->board->getField('a1'),
            toField: $this->board->getField('a1')
        );
    }
    public function testMoveThrowWhenInvalidMove(): void
    {
        $this->board->getField('a1')->setPiece($this->rook);

        $this->expectException(\Exception::class);        
        $this->board->move(
            fromField: $this->board->getField('a1'),
            toField: $this->board->getField('b2')
        );
    }

    public function testValidMove(): void
    {
        // given
        $rook = new Rook(Color::WHITE);
        $fromField = new Field('A1', $rook);
        $toField = new Field('A2', null);

        // when
        $this->board->move($fromField, $toField);

        // then original field empty
        $this->assertNull($fromField->getPiece());

        // and rook moved to the target field
        $this->assertSame($rook, $toField->getPiece());
    }

    #[DataProvider('existingFieldProvider')]
    public function testValidGetField(
        Board $board,
        string $coords
    ): void {

        $this->assertEquals(
            $board->getField($coords),
            new Field($coords)
        );
    }

    public static function existingFieldProvider()
    {
        return [
            'Field(a2)  in Board()'   => [new Board(),   'a2'],
            'Field(h8)  in Board()'   => [new Board(),   'h8'],
            'Field(a1)  in Board(3)'  => [new Board(3),  'a1'],
            'Field(p16) in Board(20)' => [new Board(20), 'p16'],
        ];
    }

    #[DataProvider('nonExistingFieldProvider')]
    public function testGetFieldThrowWhenInvalid(
        Board $board,
        string $coords
    ): void {
        $this->expectException(\Exception::class);

        $board->getField($coords);
    }


    public static function nonExistingFieldProvider()
    {
        return [
            'Field(i1)  not in Board()'   => [new Board(),   'i1'],
            'Field(a12) not in Board()'   => [new Board(),   'a12'],
            'Field(x1)  not in Board()'   => [new Board(),   'x1'],
            'Field(a9)  not in Board()'   => [new Board(),   'a9'],
            'Field(d4)  not in Board(3)'  => [new Board(3),  'd4'],
            'Field(o16) not in Board(15)' => [new Board(15), 'o16'],
        ];
    }
}
