<?php

$requestPath = $_SERVER['REQUEST_URI'];

switch ($requestPath) {
    default:
        require __DIR__ . '/views/index.php';
        break;
}