<?php

return [
    // Pages
    '/'                         => ['HomeController', 'index'],
    '/tarifs'                   => ['HomeController', 'pricing'],

    // Compression API
    '/api/compress'             => ['CompressController', 'compress'],
    '/api/compress-batch'       => ['CompressController', 'compressBatch'],
    '/api/download/{filename}'  => ['CompressController', 'download'],

    // Auth
    '/connexion'                => ['AuthController', 'login'],
    '/inscription'              => ['AuthController', 'register'],
    '/deconnexion'              => ['AuthController', 'logout'],

    // Dashboard
    '/tableau-de-bord'          => ['DashboardController', 'index'],
    '/tableau-de-bord/compte'   => ['DashboardController', 'account'],

    // Payments
    '/api/create-checkout'      => ['PaymentController', 'createCheckout'],
    '/api/stripe-webhook'       => ['PaymentController', 'webhook'],
    '/paiement/succes'          => ['PaymentController', 'success'],
    '/paiement/annule'          => ['PaymentController', 'cancel'],

    // SEO pages
    '/compresser-png'           => ['SeoController', 'compresserPng'],
    '/compresser-jpeg'          => ['SeoController', 'compresserJpeg'],
    '/compresser-webp'          => ['SeoController', 'compresserWebp'],
    '/reduire-taille-image'     => ['SeoController', 'reduireTaille'],
    '/optimiser-image-web'      => ['SeoController', 'optimiserWeb'],

    // Legal
    '/mentions-legales'         => ['HomeController', 'legal'],
    '/politique-de-confidentialite' => ['HomeController', 'privacy'],
    '/cgu'                      => ['HomeController', 'terms'],
];
