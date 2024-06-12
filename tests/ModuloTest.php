<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Chess\Modulo;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Modulo::class)]
final class ModuloTest extends TestCase
{

    #[DataProvider('moduloProvider')]
    public function testValideResult(bool $expected, int $value, int $modBy): void
    {
        $this->assertSame(
            $expected,
            Modulo::isModulo(value: $value, modBy: $modBy)
        );
    }

    public static function moduloProvider()
    {
        return [
            '42 mod 2 = True' => [true, 42, 2],
            '21 mod 7 = True' => [true, 21, 7],
            
            '99 mod 5 = False' => [false, 99, 5],
            '41 mod 2 = False' => [false, 41, 2]
        ];
    }

    #[DataProvider('moduloErrorProvider')]
    public function testThrowsWhenModByIsText($value, $modBy): void
    {
        $this->expectException(\Exception::class);
        Modulo::isModulo(value: $value, modBy: $modBy);
    }

    public static function moduloErrorProvider()
    {
        return [
            'd1' => [25, "Hakuna Matata"],
            'd2' => ["Hakuna Matata", 25],
        ];
    }
}
