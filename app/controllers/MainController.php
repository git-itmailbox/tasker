<?php
namespace app\controllers;

use \app\models\Main;
use app\models\Tasks;

/**
 * Created by PhpStorm.
 * User: yura
 * Date: 02.03.17
 * Time: 1:22
 */
class MainController extends AppController
{
//    public $layout = 'main';
//    public $layout = false;


    public function indexAction()
    {
        $model = new Main();
        $name = "Yura";
        $this->set(['name' => $name]);

    }

    public function createAction()
    {
        $model = new Tasks();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $model->description=$_POST['description'];
            $model->userName=$_POST['userName'];
            $model->email=$_POST['email'];
            $model->image=$_POST['image'];

            if($model->save())
                header('Location: /');
//            $model->save();
        }
        $this->set(['model' => $model]);

    }

    public function testAction()
    {
//        echo "Main Controller test action";
    }

}