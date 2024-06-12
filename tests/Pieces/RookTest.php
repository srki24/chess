<?php

declare(strict_types=1);

use Chess\Game\Field;
use Chess\Pieces\Rook;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class RookTest extends TestCase
{

    #[DataProvider('moveProvider')]
    public function testMove(
        bool $expected,
        Field $fromField,
        Field $toField
    ): void {

        $this->assertSame(
            $expected,
            Rook::isValidMove($fromField, $toField)
        );
    }

    public static function moveProvider()
    {
        return [
            'R a1-b1 (valid)' => [true,  new Field('a1'),  new Field('b1')],
            'R a1-a2 (valid)' => [true,  new Field('a1'),  new Field('a2')],
            'R d2-c2 (valid)' => [true,  new Field('d2'),  new Field('c2')],
            'R d2-d7 (valid)' => [true,  new Field('d2'),  new Field('d7')],
            'R h5-a5 (valid)' => [true,  new Field('h5'),  new Field('a5')],
            'R h5-h2 (valid)' => [true,  new Field('h5'),  new Field('h2')],
            'R g7-g1 (valid)' => [true,  new Field('g7'),  new Field('g1')],
            'R g7-a7 (valid)' => [true,  new Field('g7'),  new Field('a7')],

            'R a1-h9 (invalid)' => [false, new Field('a1'), new Field('h9')],
            'R a1-b2 (invalid)' => [false, new Field('a1'), new Field('b2')],
            'R d2-g3 (invalid)' => [false, new Field('d2'), new Field('g3')],
            'R d2-a7 (invalid)' => [false, new Field('d2'), new Field('a7')],
            'R h5-a6 (invalid)' => [false, new Field('h5'), new Field('a6')],
            'R h5-g3 (invalid)' => [false, new Field('h5'), new Field('g3')],
            'R g7-f3 (invalid)' => [false, new Field('g7'), new Field('f3')],
            'R g7-a2 (invalid)' => [false, new Field('g7'), new Field('a2')],
        ];
    }
}

