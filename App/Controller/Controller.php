<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 19.02.2019
 * Time: 10:12
 */

namespace App\Controller;


use Base;
use DB\SQL;

class Controller
{

    protected $_db;

    public function __construct()
    {
        $f3 = Base::instance();
        $db = new SQL("mysql:host={$f3->get('DB_HOST')};dbname={$f3->get('DB_NAME')}", $f3->get('DB_USER'), $f3->get('DB_PAS'));
        $this->_db = $db;
    }

    public function getDB()
    {
        return $this->_db;
    }

}
