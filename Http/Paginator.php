<?php

namespace Http;

class Paginator
{
    protected static int $total;
    protected static int $page;
    protected static int $quantity;
    protected static int $totalPages;
    protected static bool $hasPreviousPage;
    protected static bool $hasNextPage;

    public static function Paginate(array $items, int $page, int $quantity): array
    {
        $total = count($items);
        $totalPages = ceil($total / $quantity);
        $hasPreviousPage = $page > 1;
        $hasNextPage = $page < $totalPages;

        $startIndex = ($page - 1) * $quantity;
        $paginatedItems = array_slice($items, $startIndex, $quantity);

        self::bindingPaginate($total, $page, $quantity, $totalPages, $hasPreviousPage, $hasNextPage);

        return [
            'items' => $paginatedItems,
            'pagination' => [
                'total' => self::$total,
                'page' => self::$page,
                'quantity' => self::$quantity,
                'totalPages' => self::$totalPages,
                'hasPreviousPage' => self::$hasPreviousPage,
                'hasNextPage' => self::$hasNextPage,
            ],
        ];
    }

    /**
     * @param int $total
     * @param int $page
     * @param int $quantity
     * @param float $totalPages
     * @param bool $hasPreviousPage
     * @param bool $hasNextPage
     * @return void
     */
    public static function bindingPaginate(int $total, int $page, int $quantity, float $totalPages, bool $hasPreviousPage, bool $hasNextPage): void
    {
        self::$total = $total;
        self::$page = $page;
        self::$quantity = $quantity;
        self::$totalPages = $totalPages;
        self::$hasPreviousPage = $hasPreviousPage;
        self::$hasNextPage = $hasNextPage;
    }
}