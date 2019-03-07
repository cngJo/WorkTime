<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 07.03.2019
 * Time: 10:24
 */

namespace App\Controller;


use App\Models\UserModel;

class UserController extends Controller
{

    function login()
    {
        echo \Template::instance()->render('forms/login.php');
    }

    function register()
    {
        echo \Template::instance()->render('forms/register.php');
    }

    function logout()
    {
        echo \Template::instance()->render('forms/logout.php');
    }

    /**
     * Backend Logic
     */

    function UserRegister()
    {
        self::clearSessionVariables();

        /** @var \Base $f3 */
        $f3 = \Base::instance();

        $error = true;

        $user = new UserModel();

        $username = $f3->get('POST.username');
        $password = $f3->get('POST.password');
        $email = $f3->get('POST.email');

        $credentials = $user->checkCredentials($username, $password, $email);

        if ($credentials === true) {
            $user->username = $username;
            $user->password = $user->hashPassword($password);
            $user->email = $email;
            $user->role = "user";
            $user->save();
            $error = false;
        } else {
            $f3->set('SESSION.error.message', $credentials);
            $error = true;
        }

        if ($error) {
            $f3->reroute('/register');
        } else {
            $f3->reroute('/');
        }

        $f3->reroute('/register');
    }

    function UserLogin()
    {

    }

    function UserLogout()
    {

    }
}
