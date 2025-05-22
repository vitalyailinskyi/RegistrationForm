<?php

declare(strict_types=1);

namespace Src\Model;

use PDO;
use Src\Database\Connection;
use Src\Config;

class UserModel {
    private Connection $db;

    public function __construct(protected Config $config, protected Connection $connection)
    {
        $this->db = new Connection($config);
    }

    public function createUser(string $name, string $email, string $password): bool
    {
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public function findByEmail(string $email): ?array
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;

    }
}