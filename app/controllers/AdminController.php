<?php
namespace app\controllers;

use app\models\Tasks;
require_once LIBS . '/Auth.php';

/**
 * Created by PhpStorm.
 * User: yura
 * Date: 02.03.17
 * Time: 1:22
 */
class AdminController extends AppController
{

    private $user;

    public function indexAction()
    {

        $this->user = Auth::run();
        if (!$this->user) {
            header("Location:  /admin/login");
        }

        $model = new Tasks();
        $tasks = $model->findAll();
        $this->set(['tasks'=>$tasks]);

    }

    public function loginAction()
    {
        if(!$this->user)
            $this->user = Auth::run();
        if($this->user !== false)
            header("Location:  /admin/");
        return;
    }


    public function updateAction()
    {
        $this->layout = false;
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            $model  = new Tasks();
            $id=(int)$_POST['id'];
            if(is_int($id)){
               $model->load($id);
                $model->description=$_POST['description'];
                $model->update();
                echo $model->description;
            }
        }

    }
}