<?php

class CompressController
{
    /**
     * Server-side compression (Pro feature for mega compression)
     */
    public function compress(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            jsonResponse(['error' => 'Méthode non autorisée'], 405);
        }

        if (!isset($_FILES['image'])) {
            jsonResponse(['error' => 'Aucune image fournie'], 400);
        }

        $file = $_FILES['image'];
        $quality = (int) ($_POST['quality'] ?? 80);
        $megaCompress = ($_POST['mega'] ?? '0') === '1';

        // Check if mega compression requires Pro
        if ($megaCompress && !isPro()) {
            jsonResponse(['error' => 'La méga compression nécessite un abonnement Pro.'], 403);
        }

        // Validate file
        $maxSize = isPro() ? PRO_MAX_FILE_SIZE : FREE_MAX_FILE_SIZE;
        if ($file['size'] > $maxSize) {
            jsonResponse(['error' => 'Fichier trop volumineux. Maximum : ' . formatSize($maxSize)], 400);
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedTypes)) {
            jsonResponse(['error' => 'Format non supporté. Utilisez PNG, JPEG ou WebP.'], 400);
        }

        // Rate limiting for free users
        if (!isPro()) {
            $today = date('Y-m-d');
            $sessionKey = 'compress_count_' . $today;
            $count = $_SESSION[$sessionKey] ?? 0;
            if ($count >= FREE_DAILY_LIMIT) {
                jsonResponse(['error' => 'Limite quotidienne atteinte. Passez en Pro pour des compressions illimitées.'], 429);
            }
            $_SESSION[$sessionKey] = $count + 1;
        }

        // Process image
        $image = null;
        switch ($mimeType) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($file['tmp_name']);
                break;
            case 'image/png':
                $image = imagecreatefrompng($file['tmp_name']);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($file['tmp_name']);
                break;
        }

        if (!$image) {
            jsonResponse(['error' => 'Impossible de traiter cette image.'], 500);
        }

        // Get original dimensions
        $origWidth = imagesx($image);
        $origHeight = imagesy($image);

        // For mega compression, also resize if very large
        if ($megaCompress && ($origWidth > 2000 || $origHeight > 2000)) {
            $ratio = min(2000 / $origWidth, 2000 / $origHeight);
            $newWidth = (int) ($origWidth * $ratio);
            $newHeight = (int) ($origHeight * $ratio);
            $resized = imagecreatetruecolor($newWidth, $newHeight);

            // Preserve transparency for PNG/WebP
            if ($mimeType === 'image/png' || $mimeType === 'image/webp') {
                imagealphablending($resized, false);
                imagesavealpha($resized, true);
                $transparent = imagecolorallocatealpha($resized, 0, 0, 0, 127);
                imagefill($resized, 0, 0, $transparent);
            }

            imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
            imagedestroy($image);
            $image = $resized;
        }

        // Set compression quality
        if ($megaCompress) {
            $quality = max(20, $quality - 30);
        }

        // Generate output
        $ext = match ($mimeType) {
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
        };
        $outputName = generateFilename($ext);
        $outputPath = UPLOADS_PATH . '/' . $outputName;

        switch ($mimeType) {
            case 'image/jpeg':
                imagejpeg($image, $outputPath, $quality);
                break;
            case 'image/png':
                // PNG quality is 0-9 (0=no compression, 9=max)
                $pngQuality = (int) (9 - ($quality / 100 * 9));
                if ($megaCompress) $pngQuality = 9;
                imagealphablending($image, false);
                imagesavealpha($image, true);
                imagepng($image, $outputPath, $pngQuality);
                break;
            case 'image/webp':
                imagewebp($image, $outputPath, $quality);
                break;
        }

        imagedestroy($image);

        $originalSize = $file['size'];
        $compressedSize = filesize($outputPath);

        // Log compression if user is logged in
        if (isLoggedIn()) {
            $compression = new Compression();
            $compression->create([
                'user_id'         => currentUserId(),
                'original_name'   => $file['name'],
                'original_size'   => $originalSize,
                'compressed_size' => $compressedSize,
                'format'          => $ext,
                'mega'            => $megaCompress ? 1 : 0,
            ]);
        }

        jsonResponse([
            'success'         => true,
            'filename'        => $outputName,
            'original_name'   => pathinfo($file['name'], PATHINFO_FILENAME) . '-compresse.' . $ext,
            'original_size'   => $originalSize,
            'compressed_size' => $compressedSize,
            'reduction'       => formatPercent($originalSize, $compressedSize),
            'download_url'    => url('/api/download/' . $outputName),
        ]);
    }

    public function compressBatch(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            jsonResponse(['error' => 'Méthode non autorisée'], 405);
        }

        if (!isset($_FILES['images'])) {
            jsonResponse(['error' => 'Aucune image fournie'], 400);
        }

        $maxBatch = isPro() ? PRO_MAX_BATCH : FREE_MAX_BATCH;
        $fileCount = count($_FILES['images']['name']);

        if ($fileCount > $maxBatch) {
            jsonResponse(['error' => "Maximum $maxBatch images par lot."], 400);
        }

        $results = [];
        for ($i = 0; $i < $fileCount; $i++) {
            $_FILES['image'] = [
                'name'     => $_FILES['images']['name'][$i],
                'type'     => $_FILES['images']['type'][$i],
                'tmp_name' => $_FILES['images']['tmp_name'][$i],
                'error'    => $_FILES['images']['error'][$i],
                'size'     => $_FILES['images']['size'][$i],
            ];

            if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                $results[] = ['error' => 'Erreur upload: ' . $_FILES['images']['name'][$i]];
                continue;
            }

            ob_start();
            $this->compress();
            $output = ob_get_clean();
            $results[] = json_decode($output, true);
        }

        jsonResponse(['results' => $results]);
    }

    public function download(string $filename): void
    {
        // Sanitize filename
        $filename = basename($filename);
        $filepath = UPLOADS_PATH . '/' . $filename;

        if (!file_exists($filepath)) {
            http_response_code(404);
            echo 'Fichier non trouvé.';
            exit;
        }

        $mimeType = mime_content_type($filepath);
        $originalName = $_GET['name'] ?? $filename;

        header('Content-Type: ' . $mimeType);
        header('Content-Disposition: attachment; filename="' . basename($originalName) . '"');
        header('Content-Length: ' . filesize($filepath));
        header('Cache-Control: no-cache');

        readfile($filepath);

        // Clean up after download
        unlink($filepath);
        exit;
    }
}
