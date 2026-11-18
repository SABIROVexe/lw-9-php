<?php

declare(strict_types=1);

namespace App;

class PasswordValidator
{
    public static function validate(string $password): bool
    {
        if (mb_strlen($password) < 8) {
            return false;
        }

        if (preg_match('/\p{Lu}/u', $password) !== 1) {
            return false;
        }

        if (preg_match('/\d/u', $password) !== 1) {
            return false;
        }

        if (preg_match('/\s/u', $password) === 1) {
            return false;
        }

        return true;
    }
}
