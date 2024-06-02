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
        $b->move($b->getField(1,1), $b->getField(2,2));
    }

    public function testDontThrowWhenPieceOnField(): void
    {
        $b = new Board(); // Empty Board
        
        $piece = new Rook(color: 'WHITE');

        $fromField = $b->getField(1,1);
        $fromField->setPiece($piece);
        
        $toField = $b->getField(5,2);
        $b->move($fromField, $toField);

        // Original field empty
        $this->assertNull($fromField->getPiece());

        // Piece moved to the target field
        $this->assertSame($piece, $toField->getPiece());
    }
}
