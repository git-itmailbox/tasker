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
            return;
        }

    }


    public function loginAction()
    {
        if(!$this->user)
            $this->user = Auth::run();
        if($this->user !== false)
            header("Location:  /admin/");

        return;
//        var_dump($user);
    }

}