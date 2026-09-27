<?php

/** Daily allowance follows the essential PHP session, never the analytics choice. */
function compressionQuota(): array
{
    $day = date('Y-m-d');
    $used = (int) ($_SESSION['compress_count_' . $day] ?? 0);
    return [
        'pro' => isPro(),
        'limit' => FREE_DAILY_LIMIT,
        'remaining' => isPro() ? null : max(0, FREE_DAILY_LIMIT - $used),
        'resetsAt' => (new DateTimeImmutable('tomorrow'))->format(DateTimeInterface::ATOM),
    ];
}

function consumeCompression(): array
{
    $quota = compressionQuota();
    if ($quota['pro']) return $quota;
    if ($quota['remaining'] < 1) {
        jsonResponse(['error' => 'Vos 3 images gratuites du jour ont été utilisées. Revenez demain ou passez en Pro.', 'quota' => $quota], 429);
    }
    // The session handler serializes concurrent requests from this browser.
    $key = 'compress_count_' . date('Y-m-d');
    $_SESSION[$key] = (int) ($_SESSION[$key] ?? 0) + 1;
    return compressionQuota();
}
