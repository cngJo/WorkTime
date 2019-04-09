<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 19.02.2019
 * Time: 10:12
 */

namespace App\Controller;


use App\Models\UserModel;
use Base;
use DB\SQL;

class Controller
{

    protected $_db;

    /**
     * Constructor for the base Controller
     *   - store an instance of DB\SQL in $this->_db, so we can access a DB instance in each controller
     */
    public function __construct()
    {
        $f3 = Base::instance();
        $db = new SQL("mysql:host={$f3->get('DB_HOST')};dbname={$f3->get('DB_NAME')}", $f3->get('DB_USER'), $f3->get('DB_PASS'));
        $this->_db = $db;
    }

    /**
     * Getter for $this->_db
     * @return SQL
     */
    public function getDB()
    {
        return $this->_db;
    }

    /**
     * Overrides all Session variables
     */
    public function clearSessionVariables()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        $f3->set('SESSION.error.message', '');
        $f3->set('SESSION.loggedin', false);
        $f3->set('SESSION.loggedinUserId', -1);
    }

    /**
     * Checks if WorkTime is installed by checking if the db config files exists
     * @return bool
     */
    public function isInstalled()
    {
        return file_exists('App/Config/installation.cfg');
    }

    /**
     * Checks if a user is logged in and is yeas, returns the id of the logged in user
     *
     * @return bool|mixed
     */
    public function getLoggedInUserID() {
        $userModel = new UserModel();
        return $userModel->isLoggedIn();
    }

}
