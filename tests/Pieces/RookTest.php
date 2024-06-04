<?php

declare(strict_types=1);

use Chess\Game\Field;
use Chess\Pieces\Rook;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class RookTest extends TestCase
{

    #[DataProvider('rookValidMoveProvider')]
    public function testValidMove(
        bool $expected,
        Field $fromField,
        Field $toField
    ): void {

        $this->assertSame(
            $expected,
            Rook::isValidMove($fromField, $toField)
        );
    }

    public static function rookValidMoveProvider()
    {
        return [
            't1' => [true,  new Field(1, 1),  new Field(2, 1)],
            't2' => [true,  new Field(1, 1),  new Field(1, 2)],
            
            'f1' => [false, new Field(1, 1),  new Field(2, 2)],
            'f2' => [false, new Field(3, 3),  new Field(2, 1)],
        ];
    }
}
