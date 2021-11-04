<?php

function jsonResponse(array $arr, int $code = 200): void
{
    http_response_code($code);
    header('Content-Type: application/json');
    exit(json_encode($arr, JSON_UNESCAPED_UNICODE));
}
