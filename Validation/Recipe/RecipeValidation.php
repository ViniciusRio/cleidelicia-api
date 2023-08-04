<?php

namespace Validation\Recipe;

use Validation\Validator;

class RecipeValidation
{

    /**
     * @throws RecipeException
     */
    public static function IdValidator(?int $id): void
    {
        if (!Validator::number($id)) {
            $error = 'Identificador da Receita não encontrado';

            RecipeException::throw($error, $id);
        }

    }
}