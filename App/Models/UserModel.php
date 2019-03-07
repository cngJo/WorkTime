<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 06.03.2019
 * Time: 16:07
 */

namespace App\Models;


use App\WorkTime;
use DB\SQL\Mapper;

class UserModel extends Mapper
{
    public function __construct()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        if ($f3->get('DB')) {
            parent::__construct($f3->get('DB'), 'users');
        } else {
            parent::__construct(WorkTime::getDB(), 'users');
        }
    }

    /**
     * Checks via the cookies, if the user is logged in, and when returns the user_id from the logged in user
     */
    public function isLoggedIn()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        if ($f3->get('COOKIE.WorkTimeLoginToken')) {
            $login_token = new LoginTokenModel();

            if ($login_token->findone(['token=?', sha1($f3->get('COOKIE.WorkTimeLoginToken'))])) {
                $user_id = $login_token->getUserID(sha1($f3->get('COOKIE.WorkTimeLoginToken')));

                if ($f3->get('COOKIE.WorkTimeLoginToken_')) {
                    return $user_id;
                } else {
                    // generate 64 random bytes for the token
                    $cstrong = true;
                    $token = openssl_random_pseudo_bytes(64, $cstrong);

                    $login_token->insertToken(sha1($token), $user_id);
                    $login_token->deleteToken(sha1($f3->get('COOKIE.WorkTimeLoginToken')));

                    setcookie("WorkTimeLoginToken", $token, time() + 60 * 60 * 24 * 7, '/', null, null, true);
                    setcookie("WorkTimeLoginToken_", 1, time() + 60 * 60 * 24 * 3, '/', null, null, true);

                    return $user_id;
                }
            }
        } else {
            return false;
        }
    }

    /**
     * returns the role of the user with the given username
     *
     * @param $username
     * @return string
     */
    public function getRole($username)
    {
        return $this->findone(['username=?', $username])->role;
    }

    /**
     * Checks if the given credentials are valid and if not, returns an corresponding error message
     *
     * @param $username
     * @param $password
     * @param $email
     * @return mixed
     */
    public function checkCredentials($username, $password, $email)
    {
        if (!$this->usernameExists($username) && !$this->emailExists($email)) {
            if ($this->isEmailValid($email)) {
                if ($this->isUsernameValid($username)) {
                    if ($this->isPasswordValid($password)) {
                        return true;
                    } else {
                        return "Password is invalid";
                    }
                } else {
                    return "Username is invalid";
                }
            } else {
                return "E-Mail address is invalid";
            }
        } else {
            return "Username or email address already in use. check if you can login.";
        }
    }

    /**
     * checks if the given username exists in the database
     *
     * @param $username
     * @return boolean
     */
    public function usernameExists($username)
    {
        return $this->find(['username=?', $username])[0];
    }

    /**
     * checks if the given email address exists in the database
     *
     * @param $email
     * @return boolean
     */
    public function emailExists($email)
    {
        return $this->find(['email=?', $email])[0];
    }

    /**
     * checks if the given username is valid (3-32 characters and matches /[a-zA-Z0-9_]+/)
     *
     * @param $username
     * @return bool
     */
    private function isUsernameValid($username)
    {
        return (strlen($username) >= 3 && strlen($username) <= 32) && (preg_match('/[a-zA-Z0-9_]+/', $username));
    }

    /**
     * checks if the given password is valid (6-60 characters)
     *
     * @param $password
     * @return bool
     */
    private function isPasswordValid($password)
    {
        return strlen($password) >= 6 && strlen($password) <= 60;
    }

    /**
     * checks if the given email address is valid (filter_var($email, FILTER_VALIDATE_EMAIL)
     *
     * @param $email
     * @return mixed
     */
    private function isEmailValid($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * hashes and returns teh given password with the BYCRYPT algorithm.
     * todo: get the algorithm from a config file
     *
     * @param $password
     * @return string
     */
    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * checks if the given password matches the password stored in the database
     *
     * @param $username
     * @param $password
     * @return boolean
     */
    private function checkPassword($username, $password)
    {
        return password_verify($password, $this->findone(['username=?', $username])[0]->password);
    }
}
