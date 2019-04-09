<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 07.03.2019
 * Time: 10:24
 */

namespace App\Controller;


use App\Models\LoginTokenModel;
use App\Models\UserModel;

use Base;

class UserController extends Controller
{

    function login()
    {
        $userModel = new UserModel();
        Base::instance()->set('user.name', $userModel->findone(array('id=?', $userModel->isLoggedIn()))->username);
        echo \Template::instance()->render('forms/login.php');
    }

    function register()
    {
        $userModel = new UserModel();
        Base::instance()->set('user.name', $userModel->findone(array('id=?', $userModel->isLoggedIn()))->username);
        echo \Template::instance()->render('forms/register.php');
    }

    function logout()
    {
        $userModel = new UserModel();
        Base::instance()->set('user.name', $userModel->findone(array('id=?', $userModel->isLoggedIn()))->username);
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
        self::clearSessionVariables();

        /** @var \Base $f3 */
        $f3 = \Base::instance();
        $error = true;

        $username = $f3->get('POST.username');
        $password = $f3->get('POST.password');

        $userModel = new UserModel();

        if ($userModel->usernameExists($username)) {
            if ($userModel->checkPasswordFromUsername($username, $password)) {
                $cstrong = true;
                $token = openssl_random_pseudo_bytes(64, $cstrong);

                $user_id = $userModel->findone(['username=?', $username])->id;

                $login_token = new LoginTokenModel();
                $login_token->insertToken(sha1($token), $user_id);

                setcookie("WorkTimeLoginToken", $token, time() + 60 * 60 * 24 * 7, '/', null, null, true);
                setcookie("WorkTimeLoginToken_", 1, time() + 60 * 60 * 24 * 3, '/', null, null, true);

                $error = false;
            } else {
                $user_id = -1;
                $error = true;
            }
        } else {
            $user_id = -1;
            $error = true;
        }

        if ($error) {
            $f3->set('SESSION.error.message', 'Invalid login data');
            $f3->reroute('/login');
        } else {
            $f3->set('SESSION.loggedin', true);
            $f3->set('SESSION.loggesinUserId', $user_id);
            $f3->reroute('/');
        }

    }

    function UserLogout()
    {
        self::clearSessionVariables();

        /** @var \Base $f3 */
        $f3 = \Base::instance();

        $user = new UserModel();
        $login_token = new LoginTokenModel();

        if (!$user->isLoggedIn()) {
            // todo: create view for this error
            echo "not logged in <a href='/'>HOME</a>";
            die();
        }

        if ($f3->get('POST.alldevices')) {
            $login_token->deleteUserToken($user->isLoggedIn());
        } else {
            if ($f3->get('COOKIE.WorkTimeLoginToken')) {
                $login_token->deleteToken(sha1($f3->get('COOKIE.WorkTimeLoginToken')));
            }
            setcookie('WorkTimeLoginToken', '', time() - 3600);
            setcookie('WorkTimeLoginToken_', '', time() - 3600);
        }
        $f3->set('SESSION.loggedin', 'false');
        $f3->set('SESSION.loggesinUserId', -1);
        $f3->reroute('/');
    }

    function changeUserData()
    {
        $f3 = \Base::instance();
        $userModel = new UserModel();

        $username = $f3->get('POST.username');
        $email = $f3->get('POST.email');
        $password = $f3->get('POST.password');
        $password_hash = $userModel->hashPassword($password);


        $user = $userModel->findone(['id=?', $userModel->isLoggedIn()]);

        if (($user->username !== $username) && (!$userModel->usernameExists($username)) && ($userModel->isUsernameValid($username)))
        {
            $user->username = $username;
        }

        if (($user->email !== $email) && (!$userModel->emailExists($email)) && ($userModel->isEmailValid($email)))
        {
            $user->email = $email;
        }

        if (($user->password !== $password_hash) && ($userModel->isPasswordValid($password))) {
            unset($password);
            $user->password = $password_hash;
        }

        $user->save();
        $f3->reroute('/profile');
    }
}
