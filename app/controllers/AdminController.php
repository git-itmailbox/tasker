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
        $orderBy ='id';
        $this->user = Auth::run();
        if (!$this->user) {
            header("Location:  /admin/login");
        }

//        var_dump($this->route);
        $model = new Tasks();
        if( isset($this->route['order'])
            &&  in_array($this->route['order'], ['email','id', 'is-done'])){
            $orderBy = str_replace('-','_',$this->route['order']);
        }

        $tasks = $model->findAll($orderBy);
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
                if(isset($_POST['description'])) $model->description=$_POST['description'];
                if(isset($_POST['is_done'])) $model->is_done=($_POST['is_done']==='true')? 1 : 0;
                if($model->update()) {
                    echo $model->description;
                    echo json_encode([
                        'id' => $model->id,
                        'description' => $model->description,
                        'is_done' => (bool)$model->is_done,
                    ]);
                }
                else{
                    echo json_decode([
                       'error' => 'Cant chaenge state',
                    ]);
                }
//
            }
        }

    }
}