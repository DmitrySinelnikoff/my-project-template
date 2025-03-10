<?php

function checkPost(): void
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        include './views/error.php';
        die;
    }
}

function addOldValue(): void
{
    foreach($_POST as $key => $item) {
        $_SESSION[$key] = $item;
    }
}

function getOldValue(string $name): void
{
    echo $_SESSION[$name] ?? null;
}

function setError(string $errrorMessage): void
{
    $_SESSION['error'] = $errrorMessage;
}

function getError(): mixed
{
    return $_SESSION['error'] ?? null;
}