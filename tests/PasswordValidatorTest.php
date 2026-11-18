<?php

declare(strict_types=1);

namespace Tests;

use App\PasswordValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class PasswordValidatorTest extends TestCase
{
    #[DataProvider('passwordProvider')]
    public function testValidate(string $password, bool $expected): void
    {
        $this->assertSame($expected, PasswordValidator::validate($password));
    }

    /**
     * @return array<string, array{string, bool}>
     */
    public static function passwordProvider(): array
    {
        return [
            'валидный пароль (ровно 8 символов)' => ['Secret12', true],
            'валидный длинный пароль со спецсимволами' => ['Super_Pass99!', true],
            'валидный пароль на кириллице' => ['Пароль123', true],
            'пустая строка' => ['', false],
            'меньше 8 символов (7 символов)' => ['Pass123', false],
            'нет заглавных букв' => ['secret123', false],
            'нет цифр' => ['SecretPass', false],
            'содержит пробел в середине' => ['Secret 123', false],
            'содержит пробел в начале' => [' Secret123', false],
            'содержит пробел в конце' => ['Secret123 ', false],
            'содержит символ табуляции' => ["Secret\t123", false],
        ];
    }
}
