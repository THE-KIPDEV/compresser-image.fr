<?php

function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrfField(): string
{
    return '<input type="hidden" name="_token" value="' . csrfToken() . '">';
}

function verifyCsrf(): bool
{
    $token = $_POST['_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    return hash_equals(csrfToken(), $token);
}

function requireCsrf(): void
{
    if (!verifyCsrf()) {
        http_response_code(403);
        jsonResponse(['error' => 'Token CSRF invalide'], 403);
    }
}
