<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 06.03.2019
 * Time: 16:09
 */

namespace App;


use Base;
use DB\SQL;
use App\Models\UserModel;

class WorkTime
{
    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        $f3->config('App/Config/config.cfg');
        $f3->config('App/Config/routes.cfg');
        $f3->config('App/Config/installation.cfg');
        $f3->config("App/Config/languages/{$f3->get('LANG')}.cfg");

        if ($f3->get('DB_HOST'))
            $f3->set('DB', $this->getDB());

        if ($this->isInstalled()) {
            $this->handleLoggedinUser();
        }
    }

    public function run()
    {
        \Base::instance()->run();
    }

    public static function getDB()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();
        $f3->config('App/Config/installation.cfg');
        return new SQL("mysql:host={$f3->get('DB_HOST')};dbname={$f3->get('DB_NAME')}", $f3->get('DB_USER'), $f3->get('DB_PASS'));
    }

    public function handleLoggedinUser()
    {
        $f3 = Base::instance();
        $userModel = new UserModel();
        $user_id = $userModel->isLoggedIn();

        if ($user_id !== false && $user_id !== null) {
            $f3->set('SESSION.loggedin', true);
            $f3->set('SESSION.loggedinUserId', $user_id);
        } else {
            $f3->set('SESSION.loggedin', false);
            $f3->set('SESSION.loggedinUserId', -1);
        }
    }

    /**
     * Checks if WorkTime is installed by checking if the db config files exists
     * @return bool
     */
    public static function isInstalled()
    {
        return file_exists('App/Config/installation.cfg');
    }
}
