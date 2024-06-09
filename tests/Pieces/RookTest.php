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
            't1' => [true,  new Field('A1'),  new Field('B1')],
            't2' => [true,  new Field('A1'),  new Field('A2')],
            
            'f1' => [false, new Field('A1'),  new Field('B2')],
            'f2' => [false, new Field('C3'),  new Field('B1')],
        ];
    }
}
