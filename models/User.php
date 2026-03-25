<?php

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    }

    public function findByStripeCustomerId(string $customerId): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE stripe_customer_id = ?');
        $stmt->execute([$customerId]);
        return $stmt->fetch() ?: null;
    }

    public function create(string $email, string $password): int
    {
        $stmt = $this->db->prepare('INSERT INTO users (email, password, plan, created_at) VALUES (?, ?, ?, NOW())');
        $stmt->execute([$email, password_hash($password, PASSWORD_BCRYPT), 'free']);
        return (int) $this->db->lastInsertId();
    }

    public function updatePassword(int $id, string $password): void
    {
        $stmt = $this->db->prepare('UPDATE users SET password = ? WHERE id = ?');
        $stmt->execute([password_hash($password, PASSWORD_BCRYPT), $id]);
    }

    public function updatePlan(int $id, string $plan, ?string $stripeCustomerId = null): void
    {
        if ($stripeCustomerId) {
            $stmt = $this->db->prepare('UPDATE users SET plan = ?, stripe_customer_id = ?, plan_expires_at = NULL WHERE id = ?');
            $stmt->execute([$plan, $stripeCustomerId, $id]);
        } else {
            $stmt = $this->db->prepare('UPDATE users SET plan = ?, plan_expires_at = NULL WHERE id = ?');
            $stmt->execute([$plan, $id]);
        }
    }

    public function updatePlanExpiry(int $id, string $expiresAt): void
    {
        $stmt = $this->db->prepare('UPDATE users SET plan_expires_at = ? WHERE id = ?');
        $stmt->execute([$expiresAt, $id]);
    }
}
