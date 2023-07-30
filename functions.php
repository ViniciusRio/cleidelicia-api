<?php

function dd($value): void
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

function base_path($path): string
{
    return BASE_PATH . $path;
}

function response($message = null, $httpCode = 200): void
{
    header_remove();
    http_response_code($httpCode);
    header("Content-Type: application/json");
    echo json_encode(array(
        'message' => $message
    ));
    exit();
}