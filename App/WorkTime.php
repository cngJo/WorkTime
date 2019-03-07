<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 06.03.2019
 * Time: 16:09
 */

namespace App;


use DB\SQL;

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
    }

    public function run()
    {
        \Base::instance()->run();
    }

    public static function getDB() {
        /** @var \Base $f3 */
        $f3 = \Base::instance();
        $f3->config('App/Config/installation.cfg');
        return new SQL("mysql:host={$f3->get('DB_HOST')};dbname={$f3->get('DB_NAME')}", $f3->get('DB_USER'), $f3->get('DB_PASS'));
    }

}
