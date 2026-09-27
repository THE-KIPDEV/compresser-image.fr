<?php

class QuotaController
{
    public function status(): void
    {
        header('Cache-Control: no-store, private');
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'GET') jsonResponse(compressionQuota());
        if ($method !== 'POST') jsonResponse(['error' => 'Méthode non autorisée'], 405);
        requireCsrf();
        jsonResponse(consumeCompression());
    }
}
