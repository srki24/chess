<?php

declare(strict_types=1);

use Chess\Game\Field;
use Chess\Pieces\Bishop;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class BishopTest extends TestCase
{

    #[DataProvider('moveProvider')]
    public function testMove(
        bool $expected,
        Field $fromField,
        Field $toField
    ): void {

        $this->assertSame(
            $expected,
            Bishop::isValidMove($fromField, $toField)
        );
    }

    public static function moveProvider()
    {
        return [
            'B a1-d4 (valid)' => [true,  new Field('a1'),  new Field('d4')],
            'B a1-h8 (valid)' => [true,  new Field('a1'),  new Field('h8')],
            'B d2-c1 (valid)' => [true,  new Field('d2'),  new Field('c1')],
            'B d2-a5 (valid)' => [true,  new Field('d2'),  new Field('a5')],
            'B h5-d1 (valid)' => [true,  new Field('h5'),  new Field('d1')],
            'B h5-e8 (valid)' => [true,  new Field('h5'),  new Field('e8')],
            'B g7-h8 (valid)' => [true,  new Field('g7'),  new Field('h8')],
            'B g7-a1 (valid)' => [true,  new Field('g7'),  new Field('a1')],

            'B a1-a5 (invalid)' => [false, new Field('a1'), new Field('a5')],
            'B a1-a2 (invalid)' => [false, new Field('a1'), new Field('a2')],
            'B d2-d3 (invalid)' => [false, new Field('d2'), new Field('d3')],
            'B d2-a7 (invalid)' => [false, new Field('d2'), new Field('a7')],
            'B h5-h6 (invalid)' => [false, new Field('h5'), new Field('h6')],
            'B h5-g3 (invalid)' => [false, new Field('h5'), new Field('g3')],
            'B g7-h7 (invalid)' => [false, new Field('g7'), new Field('h7')],
            'B g7-a2 (invalid)' => [false, new Field('g7'), new Field('a2')],
        ];
    }
}
