<?php
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 02.03.17
 * Time: 16:56
 */

namespace app\controllers;
require_once LIBS . '/Auth.php';

class AppController extends \vendor\core\base\Controller
{
    protected $user;

    public function __construct($route)
    {
        parent::__construct($route);

        $this->user = Auth::run();

        self::setAuth($this->user);
    }

}