<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 02.03.17
 * Time: 23:19
 */

namespace vendor\core;


class Db
{
    protected $pdo;
    protected static $instance;

    private function __construct()
    {
        $db = require ROOT . '/config/config_db.php';
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        ];
        $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);
    }

    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function execute($sql,  $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);

        $res = $stmt->execute($params);
        if ($res !== false) {
            return $stmt->fetchAll();
        }
        return [];
    }

    public function queryBindParams($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        var_dump($stmt);

        return $stmt->execute();
    }

}
