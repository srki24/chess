<?php

declare(strict_types=1);

use Chess\Game\Board;
use Chess\Game\Field;
use Chess\Pieces\Rook;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class BoardTest extends TestCase
{

    private $board;
    protected function setUp(): void
    {
        $this->board = new Board();
    }

    public function testMoveThrowWhenMoveFromEmptyField(): void
    {
        $this->expectException(\Exception::class);
        $this->board->move(
            fromField: new Field('A1'),
            toField: new Field('B2')
        );
    }

    public function testValidMove(): void
    {
        // given
        $rook = new Rook(color: 'WHITE');
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
            'Field(A2)  in Board()'   => [new Board(),   'A2'],
            'Field(H8)  in Board()'   => [new Board(),   'H8'],
            'Field(A1)  in Board(3)'  => [new Board(3),  'A1'],
            'Field(P16) in Board(20)' => [new Board(20), 'P16'],
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
            'Field(I1)  not in Board()'   => [new Board(),  'I1'],
            'Field(A12) not in Board()'   => [new Board(),  'A12'],
            'Field(X1)  not in Board()'   => [new Board(),  'X9'],
            'Field(A9)  not in Board()'   => [new Board(),  'A9'],
            'Field(D4)  not in Board(3)'  => [new Board(3), 'D4'],
            'Field(P16) not in Board(15)' => [new Board(15), 'P16'],
        ];
    }
}
