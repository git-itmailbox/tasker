<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 03.03.17
 * Time: 12:56
 */

namespace app\models;

use vendor\core\base\Model;

class Tasks extends Model
{

    public $id,
            $userName,
            $email,
            $description,
            $image;

    function __construct()
    {
        parent::__construct();
        $this->table = 'tasks';

    }


    public function save()
    {
        $sql = "INSERT INTO tasks(userName, email, description, image) VALUES (:username, :email, :description, :image)";

        $bindParams = [

            ':username'     =>  $this->userName,
            ':email'        =>  $this->email,
            ':description'  =>  $this->description,
            ':image'        =>  $this->image,
        ];
        $stmt = $this->pdo->queryBindParams($sql, $bindParams);

        return $stmt;

    }

}