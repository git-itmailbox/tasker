<?php
namespace app\controllers;

use \app\models\Tasks;
require_once LIBS . '/UploadImage.php';

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
            $model->image = UploadImage::upload( $_FILES['image'] );

            if($model->save())
                header('Location: /');
//            $model->save();
        }
        $this->set(['model' => $model]);

    }

    public function testAction()
    {

    }

}