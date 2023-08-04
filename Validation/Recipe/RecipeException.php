<?php

namespace Validation\Recipe;

use Exception;

class RecipeException extends Exception
{
    public readonly string $errors;
    public readonly ?string $old;

    /**
     * @throws RecipeException
     */
    public static function throw($errors, ?string $old)
    {
        $instance = new static;

        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;

    }
}