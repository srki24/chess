<?php

declare(strict_types=1);

use Chess\Game\Field;
use Chess\Pieces\Color;
use Chess\Pieces\Knight;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(Knight::class)]
#[UsesClass(Field::class)]
final class KnightTest extends TestCase
{

    private Knight $whiteKnight;
    private Knight $blackKnight;

    protected function setUp(): void
    {
        $this->whiteKnight = new Knight(Color::WHITE);
        $this->blackKnight = new Knight(Color::BLACK);
    }

    public function testGetColor()
    {
        $this->assertSame($this->whiteKnight->getColor(), Color::WHITE);
        $this->assertSame($this->blackKnight->getColor(), Color::BLACK);
    }

    #[DataProvider('moveProvider')]

    public function testBlackMove(
        bool $expected,
        Field $fromField,
        Field $toField
    ): void {

        $this->assertSame(
            $expected,
            $this->blackKnight->isValidMove($fromField, $toField)
        );
    }

    public static function moveProvider()
    {
        return [
            'K d4-b3 (valid)' => [true,  new Field('d4'),  new Field('b3')],
            'K d4-b5 (valid)' => [true,  new Field('d4'),  new Field('b5')],
            'K d4-f3 (valid)' => [true,  new Field('d4'),  new Field('f3')],
            'K d4-f5 (valid)' => [true,  new Field('d4'),  new Field('f5')],
            'K d4-c2 (valid)' => [true,  new Field('d4'),  new Field('c2')],
            'K d4-c6 (valid)' => [true,  new Field('d4'),  new Field('c6')],
            'K d4-e2 (valid)' => [true,  new Field('d4'),  new Field('e2')],
            'K d4-e6 (valid)' => [true,  new Field('d4'),  new Field('e6')],

            'K a1-d4 (invalid)' => [false, new Field('a1'), new Field('d4')],
            'K d4-b2 (invalid)' => [false, new Field('d4'), new Field('b2')],
            'K d4-c3 (invalid)' => [false, new Field('d4'), new Field('c3')],
            'K d4-d4 (invalid)' => [false, new Field('d4'), new Field('d4')],
            'K d4-b6 (invalid)' => [false, new Field('d4'), new Field('b6')],
            'K d4-g2 (invalid)' => [false, new Field('d4'), new Field('g2')],
            'K d4-a3 (invalid)' => [false, new Field('d4'), new Field('a3')],
            'K d4-c5 (invalid)' => [false, new Field('d4'), new Field('c5')],
        ];
    }
}
