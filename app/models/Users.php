<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 03.03.17
 * Time: 12:56
 */

namespace app\models;

use vendor\core\Db;
use vendor\core\base\Model;

class Users extends Model
{

    public $id,
            $login,
            $password,
            $hash;

    function __construct($data = ['login'=>"", 'hash'=>"", 'password'=>"", 'id'=>0 ])
    {
        parent::__construct();
        $this->table = 'users';

        $this->id      = $data['id'];
        $this->login   = $data['login'];
        $this->hash    = $data['hash'];
        $this->password  = $data['password'];
    }


    public function save()
    {
        $sql = "INSERT INTO tasks(userName, email, description, image) VALUES (:username, :email, :description, :image)";

        $bindParams = [

            ':login'     =>  $this->userName,
            ':password'        =>  $this->email,
            ':hash'  =>  $this->description,
            ':image'        =>  $this->image,
        ];
        $stmt = $this->pdo->queryBindParams($sql, $bindParams);

        return $stmt;

    }

    public static function findByLogin($login) {
        $pdo = Db::instance();
        $req = $pdo->queryOneRow("SELECT * FROM users where login = ? limit 1", [$login]);
        if(!$req) return false;
        return new Users([
            'id'     =>$req->id,
            'login'  =>$req->login,
            'hash'   =>$req->hash,
            'password' =>$req->password,
        ]);
    }

    public function updateHash($hash, $id=0)
    {
        $id=($id==0)?$this->id:$id;
        $db = Db::instance();
        $sql = "UPDATE users SET hash = ? WHERE id = ?";
        return $db->execute($sql, [$hash,$id]);
    }


}