<?php

namespace Validation;

class Validator
{
    public static function number(?int $value): bool
    {
        if ($value === null || $value < 0) {
            return false;
        }

        return true;
    }
}