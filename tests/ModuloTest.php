<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Chess\Modulo;

final class ModuloTest extends TestCase
{
    public function testNoRest(): void
    {
        $this->assertTrue(Modulo::isModulo(52));
    }

    public function testRest(): void
    {
        $this->assertFalse(Modulo::isModulo(52, 3));
    }

    public function testThrowsWhenModByIsText(): void
    {
        $this->expectException(\Exception::class);
        Modulo::isModulo(value: 25, modBy: "Hakuna Matata");
    }
    public function testThrowsWhenValueIsText(): void
    {
        $this->expectException(\Exception::class);
        Modulo::isModulo(value: 25, modBy: "Hakuna Matata");
    }
}
