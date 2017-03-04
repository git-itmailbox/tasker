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
            $is_done,
            $image;

    function __construct($attributes=[])
    {
        parent::__construct();
        $this->table        = 'tasks';
        $this->id           = (isset($attributes->id))          ? $attributes->id           : "";
        $this->userName     = (isset($attributes->userName))    ? $attributes->userName     : "";
        $this->email        = (isset($attributes->email))       ? $attributes->email        : "";
        $this->description  = (isset($attributes->description)) ? $attributes->description  : "";
        $this->is_done      = (isset($attributes->is_done))     ? $attributes->is_done         : "";
        $this->image        = (isset($attributes->image))       ? $attributes->image        : "";

    }


    public function save()
    {
        $sql = "INSERT INTO tasks(userName, email, description, image, is_done) VALUES (:username, :email, :description, :image, :is_done)";

        $bindParams = [
            ':username'     =>  $this->userName,
            ':email'        =>  $this->email,
            ':description'  =>  $this->description,
            ':image'        =>  $this->image,
            ':is_done'      =>  $this->is_done,
        ];
        $stmt = $this->pdo->queryBindParams($sql, $bindParams);

        return $stmt;
    }

    public function load($id)
    {
        $task = parent::findOne($id);

           $this->id         = $task->id;
           $this->userName   = $task->userName;
           $this->email      = $task->email;
           $this->description= $task->description;
           $this->is_done    = $task->is_done;
           $this->image      = $task->image;

    }

    public function update()
    {
        $sql = "UPDATE tasks SET  userName= :userName, email= :email, description= :description, is_done = :is_done WHERE id = :id";
        $bindParams = [

            ':userName'     =>  $this->userName,
            ':email'        =>  $this->email,
            ':description'  =>  $this->description,
            ':is_done'      =>  $this->is_done,
            ':id'           =>  $this->id,

        ];
        $stmt = $this->pdo->queryBindParams($sql, $bindParams);

        return $stmt;

    }




}