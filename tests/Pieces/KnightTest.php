<?php

declare(strict_types=1);

use Chess\Game\Field;
use Chess\Pieces\Knight;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class KnightTest extends TestCase
{

    #[DataProvider('rookValidMoveProvider')]

    public function testValidMove(
        bool $expected,
        Field $fromField,
        Field $toField
    ): void {

        $this->assertSame(
            $expected,
            Knight::isValidMove($fromField, $toField)
        );
    }

    public static function rookValidMoveProvider()
    {
        return [
            't1' => [true,  new Field('D4'),  new Field('B3')],
            't2' => [true,  new Field('D4'),  new Field('B5')],
            't3' => [true,  new Field('D4'),  new Field('F3')],
            't4' => [true,  new Field('D4'),  new Field('F5')],
            't5' => [true,  new Field('D4'),  new Field('C2')],
            't6' => [true,  new Field('D4'),  new Field('C6')],
            't7' => [true,  new Field('D4'),  new Field('E2')],
            't8' => [true,  new Field('D4'),  new Field('E6')],

            'f1' => [false, new Field('D4'), new Field('A1')],
            'f2' => [false, new Field('D4'), new Field('B2')],
            'f3' => [false, new Field('D4'), new Field('C3')],
            'f4' => [false, new Field('D4'), new Field('D4')],
            'f5' => [false, new Field('D4'), new Field('B6')],
            'f6' => [false, new Field('D4'), new Field('G2')],
            'f7' => [false, new Field('D4'), new Field('A3')],
            'f8' => [false, new Field('D4'), new Field('C5')],
        ];
    }
}
