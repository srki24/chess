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
            't1' => [true,  new Field(4, 4),  new Field(2, 3)],
            't2' => [true,  new Field(4, 4),  new Field(2, 5)],
            't3' => [true,  new Field(4, 4),  new Field(6, 3)],
            't4' => [true,  new Field(4, 4),  new Field(6, 5)],
            't5' => [true,  new Field(4, 4),  new Field(3, 2)],
            't6' => [true,  new Field(4, 4),  new Field(3, 6)],
            't7' => [true,  new Field(4, 4),  new Field(5, 2)],
            't8' => [true,  new Field(4, 4),  new Field(5, 6)],

            'f1' => [false, new Field(4, 4), new Field(1, 1)],
            'f2' => [false, new Field(4, 4), new Field(2, 2)],
            'f3' => [false, new Field(4, 4), new Field(3, 3)],
            'f4' => [false, new Field(4, 4), new Field(4, 4)],
            'f5' => [false, new Field(4, 4), new Field(2, 6)],
            'f6' => [false, new Field(4, 4), new Field(7, 2)],
            'f7' => [false, new Field(4, 4), new Field(1, 3)],
            'f8' => [false, new Field(4, 4), new Field(3, 5)],
        ];
    }
}
