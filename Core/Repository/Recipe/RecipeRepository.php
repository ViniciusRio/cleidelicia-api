<?php

namespace Core\Repository\Recipe;

use Core\Repository\Repository;

class RecipeRepository extends Repository implements RecipeRepositoryInterface
{
    public function __construct()
    {
        parent::__construct('recipes');
    }

}