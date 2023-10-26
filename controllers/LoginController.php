<?php 
namespace Controllers;

use MVC\Router;

class LoginController 
{
    public static function login(Router $router)
    {
        $router->render('auth/login', []);
    }

    public static function logout()
    {
        echo 'desde logout';
    }

    public static function forgot()
    {
        echo 'desde forgot';
    }

    public static function recover()
    {
        echo 'desde recover';
    }

    public static function create()
    {
        echo 'desde create';
    }
}
?>