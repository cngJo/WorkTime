<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 06.03.2019
 * Time: 16:07
 */

namespace App\Models;


use DB\SQL\Mapper;

class LoginTokenModel extends Mapper
{
    public function __construct()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        parent::__construct($f3->get('DB'), 'login_tokens');
    }

    /**
     * Inserts an Token into the database
     *
     * @param $token
     * @param $user_id
     */
    public function insertToken($token, $user_id) {
        $this->token = $token;
        $this->user_id = $user_id;
        $this->save();
    }

    /**
     * Returns the user_id of the user, which generated the given token.
     *
     * @param $token
     * @return mixed
     */
    public function getUserID($token) {
        return $this->findone(['token=?', $token])->user_id;
    }

    /**
     * Removes the given token from the database
     *
     * @param $token
     */
    public function deleteToken($token) {
        $this->erase(['token=?', $token]);
    }

    /**
     * Removes all tokens from the user with the given id
     *
     * @param $user_id
     */
    public function deleteUserToken($user_id) {
        $this->erase(['user_id=?', $user_id]);
    }

    /**
     * Returns an array of all tokens, assigned to the user with the given id
     *
     * @param $user_id
     * @return array
     */
    public function getUserTokens($user_id) {
        $tokens = [];
        foreach ($this->find(['user_id=?', $user_id]) as $token) {
            array_push($tokens, $token->token);
        }
        return $tokens;
    }
}
