<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use Chess\Modulo;

final class ModuloTest extends TestCase
{

    #[DataProvider('moduloProvider')]
    public function testNoRest(bool $expected, int $value, int $modBy): void
    {
        $this->assertSame(
            $expected,
            Modulo::isModulo(value: $value, modBy: $modBy)
        );
    }

    public static function moduloProvider()
    {
        return [
            'd1' => [true, 42, 2],
            'd2' => [true, 21, 7],
            'd3' => [false, 99, 5],
            'd4' => [false, 41, 2]
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
