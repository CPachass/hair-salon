<?php 
namespace Controllers;

use Classes\Email;
use Model\User;
use MVC\Router;

class LoginController 
{
    public static function login(Router $router)
    {
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST);
            $alerts = $auth->validLogin();

            if(empty($alerts)) {
                // Comprobar que exista el usuario
                $user = User::getRecordByParameter('email', $auth->email);
                if($user) {
                    if($user->checkPasswordAndVerified($auth->password)) {
                        session_start();
                        $_SESSION['id'] = $user->id;
                        $_SESSION['name'] = $user->name . ' ' . $user->lastname;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['login'] = true;

                        if ($user->admin === '1') {
                            $_SESSION['admin'] = $user->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /dates');
                        }

                        debug($_SESSION);
                    }
                } else {
                    User::setAlert('error', 'Usuario no encontrado');
                }
            }
        }

        $alerts = User::getAlerts();
        $router->render('auth/login', [
            'alerts' => $alerts
        ]);
    }

    public static function logout()
    {
        echo 'desde logout';
    }

    public static function forgot(Router $router)
    {
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST);
            $alerts = $auth->validEmail();

            if (empty($alerts)) {
                $user = User::getRecordByParameter('email', $auth->email);
                if($user && $user->confirmed === '1') {

                    // Hay que generar un nuevo Token para que genere un nuevo password
                    $user->createToken();
                    $user->save();
                    
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendInstructions();

                    // Alerta de éxito
                    User::setAlert('success', 'Revisa tu E-Mail');
                } else {
                    User::setAlert('error', 'El usuario no existe o no está confirmado');
                }
            }
        }
        
        $alerts = User::getAlerts(); 
        $router->render('auth/forgot-password', [
            'alerts' => $alerts
        ]);
    }

    public static function recover(Router $router)
    {
        $error = false;
        $alerts = [];
        $token = sanitizeHTML($_GET['token']);
        $user = User::getRecordByParameter('token', $token);

        if(!$user) {
            User::setAlert('error', 'Token no válido');
            $error = true;
        } 
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new User($_POST);
            $alerts = $auth->validPassword();

            if(empty($alerts)) {
                $user->password = null;

                $user->password = $auth->password;
                $user->hashPassword();
                $user->token = null;

                $user->save();

                header('Location: /');
            }
        }

        $alerts = User::getAlerts();
        $router->render('auth/recover', [
            'alerts' => $alerts,
            'error' => $error
        ]);
    }

    public static function create(Router $router)
    {
        $user = new User();
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->syncRecord($_POST);
            $alerts = $user->validNewAccount();

            if (empty($alerts)) {
                $result = $user->userExists();

                if ($result->num_rows) {
                    $alerts = User::getAlerts();

                } else {
                    $user->hashPassword();
                    // Generate token to valid email
                    $user->createToken();
                    // Send mail
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendConfirmation();

                    // Create user
                    $result = $user->save();
                }
            }
        }

        $router->render('auth/create-account', [
            'user' => $user,
            'alerts' => $alerts
        ]);

    }

    public static function confirm(Router $router)
    {
        $alerts = [];
        $token = sanitizeHTML($_GET['token']);
        $user = User::getRecordByParameter('token', $token);
        
        if(!$user) {
            User::setAlert('error', 'Token no válido');
        } else {
            $user->confirmed = '1';
            $user->token = null;
            $user->save();
            User::setAlert('sucess', 'Cuenta confirmada correctamente');
        }

        $alerts = User::getAlerts();
        $router->render('auth/confirm-account', [
            'alerts' => $alerts
        ]);
    }

    public static function message(Router $router)
    {
        $router->render('auth/message', []);
    }

    
}