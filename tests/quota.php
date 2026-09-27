<?php
// php tests/quota.php — no database or production session.
date_default_timezone_set('Europe/Paris');
define('FREE_DAILY_LIMIT', 3);
$pro = false;
function isPro(): bool { return $GLOBALS['pro']; }
function jsonResponse(array $data, int $code = 200): void { throw new RuntimeException($data['error'] ?? '', $code); }
require __DIR__ . '/../core/quota.php';
function check(bool $condition): void { if (!$condition) throw new RuntimeException('Quota assertion failed'); }
$_SESSION = ['compress_count_' . date('Y-m-d', strtotime('yesterday')) => 3];
check(compressionQuota()['remaining'] === 3);
for ($i = 2; $i >= 0; $i--) check(consumeCompression()['remaining'] === $i);
try { consumeCompression(); throw new LogicException('Fourth compression allowed'); } catch (RuntimeException $e) { check($e->getCode() === 429); }
$pro = true;
check(consumeCompression()['remaining'] === null);
check($_SESSION['compress_count_' . date('Y-m-d')] === 3);
echo "Quota: daily reset, three accepted, fourth rejected, Pro exempt — OK\n";
