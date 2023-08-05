<?php

namespace Models\Recipe;
class Recipe
{
    public int $id;
    public string $title;
    public string $description;
    public string $method;
    public string $ingredients;
    public string $level;
    public int $cooking_time;
    public int $preparation_time;
    public int $servers;
    public string $image;
    public string $created_at;
    public string $updated_at;

    public static function fromArrayCollection(array $dataCollection): array
    {
        $recipes = [];
        foreach ($dataCollection as $data) {
            $recipes[] = self::bindingRecipe($data);
        }

        return $recipes;
    }

    public static function bindingRecipe($data): Recipe
    {
        $recipe = new self();

        $recipe->id = $data['id'] ?? null;
        $recipe->title = $data['title'] ?? '';
        $recipe->description = $data['description'] ?? '';
        $recipe->method = $data['method'] ?? '';
        $recipe->ingredients = $data['ingredients'] ?? '';
        $recipe->level = $data['level'] ?? '';
        $recipe->cooking_time = $data['cooking_time'] ?? 0;
        $recipe->preparation_time = $data['preparation_time'] ?? 0;
        $recipe->servers = $data['servers'] ?? 0;
        $recipe->image = $data['image'] ?? '';
        $recipe->created_at = $data['created_at'] ?? '';
        $recipe->updated_at = $data['updated_at'] ?? '';

        return $recipe;

    }

    public static function getProperties(): array
    {
        $properties = [];
        $class = new \ReflectionClass(static::class);

        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $properties[] = $property->getName();
        }

        return $properties;
    }
}