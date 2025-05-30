<?php

declare(strict_types=1);

namespace Src\Database;

use PDO;
use PDOException;
use Src\Config;

class Connection
{
    private PDO $instance;

    public function __construct(Config $config)
    {
        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $db = $config->db;

        try {
            $this->instance = new PDO(
                "{$db['driver']}:host={$db['host']};dbname={$db['database']}",
                $db['user'], $db['pass'],
                $db['options'] ?? $defaultOptions
            );
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function __call(string $name, array $arguments)
    {
        return call_user_func_array([$this->instance, $name], $arguments);
    }

    public function getPdo(): PDO
    {
        return $this->instance;
    }
}