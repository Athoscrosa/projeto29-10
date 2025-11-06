<?php

namespace app\database;

use PDO;

class Connection
{
    private static $pdo = null;

    public static function connection(): PDV
    {
        try {
            if (static::$pdo) {
                return static::$pdo;
            }
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_STRINGIFY_FETCHES => false,
            ];
            static::$pdo = new PDO(
                'pgsql:host=localhost;dbname=integra_development',
                'integra',
                '@w906083W@',
                $options
            );
            static::$pdo->exec("SET NAMES 'utf8'");
            return static::$pdo;

        } catch (\PDOException $e) {
            throw new \PDOException("erro:" . $e->getMessage(), 1);
        }
    }
}
