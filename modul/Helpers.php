<?php

function checkPost(): void
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        include './views/error.php';
        die;
    }
}

function addOldValue() {
    foreach($_POST as $key => $item) {
        $_SESSION[$key] = $item;
    }
}

function getOldValue(string $name) {
    echo $_SESSION[$name] ?? null;
}

function setError(string $errrorMessage) {
    $_SESSION['error'] = $errrorMessage;
}

function getError() {
    return $_SESSION['error'] ?? null;
}