<?php
namespace app\controllers;
use \app\models\Users;
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 03.03.17
 * Time: 15:26
 */

class Auth {
    public  $error="";
    public static function run() {

        if(isset($_POST["login"]) && isset($_POST["password"])) {
            $user = $_POST["login"];
            $pass = $_POST["password"];
//            $pass = md5($_POST["password"]);
            $user = Users::findByLogin($user);
            if($user->password==$pass)
            {
                $hash = md5(Auth::generateCode(10));
                Auth::setAuthCookie($user->login, $hash);
                $user->updateHash($hash);
                return $user;
            }
            else
                echo "Wrong login/password";

        }
        else if(isset($_COOKIE["login"]) && isset($_COOKIE["hash"])) {
            $user = Users::findByLogin($_COOKIE["login"]);
            if($user->hash==$_COOKIE["hash"])
            {
                return $user;
            }
        }
        return false;
    }
    public static function clearAuthCookie() {
        foreach($_COOKIE as $key => $val) {
            if($key == "login" || $key == "hash") {
                setcookie($key, "", 0, "/");
            }
        }
    }
    private static function setAuthCookie($user, $hash) {
        setcookie("login", $user, 0, "/");
        setcookie("hash", $hash, 0, "/");
    }
//generation of random hash code
    public static function generateCode($length=6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }
}