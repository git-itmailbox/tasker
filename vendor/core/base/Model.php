<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 02.03.17
 * Time: 23:17
 */

namespace vendor\core\base;

use vendor\core\Db;

abstract class Model
{
    protected $pdo;
    protected $table;
    protected $pk = 'id';
    protected $order = 'id';

    function __construct()
    {
        $this->pdo = Db::instance();
    }

    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }

    public function findAll($order = "" , $asc='asc')
    {
        if($asc!=='asc' && $asc!=='desc' )
            $asc='asc';
        $order= $order ?: $this->order;
        $sql = "SELECT * FROM {$this->table} ORDER BY {$order} $asc";
        return $this->pdo->query($sql);
    }

    public function findOne($id, $field='')
    {
        $field = $field ?: $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE $field=? LIMIT 1;";
        return $this->pdo->queryOneRow( $sql, [$id]);

    }
}