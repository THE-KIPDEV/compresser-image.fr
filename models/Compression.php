<?php

class Compression
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create(array $data): int
    {
        $stmt = $this->db->prepare('
            INSERT INTO compressions (user_id, original_name, original_size, compressed_size, format, mega, created_at)
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ');
        $stmt->execute([
            $data['user_id'],
            $data['original_name'],
            $data['original_size'],
            $data['compressed_size'],
            $data['format'],
            $data['mega'] ?? 0,
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function getUserStats(int $userId): array
    {
        $stmt = $this->db->prepare('
            SELECT
                COUNT(*) as total_compressions,
                COALESCE(SUM(original_size), 0) as total_original,
                COALESCE(SUM(compressed_size), 0) as total_compressed,
                COALESCE(SUM(original_size) - SUM(compressed_size), 0) as total_saved
            FROM compressions WHERE user_id = ?
        ');
        $stmt->execute([$userId]);
        return $stmt->fetch();
    }

    public function getRecent(int $userId, int $limit = 20): array
    {
        $stmt = $this->db->prepare('
            SELECT * FROM compressions
            WHERE user_id = ?
            ORDER BY created_at DESC
            LIMIT ?
        ');
        $stmt->execute([$userId, $limit]);
        return $stmt->fetchAll();
    }

    public function getTodayCount(int $userId): int
    {
        $stmt = $this->db->prepare('
            SELECT COUNT(*) FROM compressions
            WHERE user_id = ? AND DATE(created_at) = CURDATE()
        ');
        $stmt->execute([$userId]);
        return (int) $stmt->fetchColumn();
    }
}
