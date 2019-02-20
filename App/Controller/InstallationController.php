<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 20.02.2019
 * Time: 08:36
 */

namespace App\Controller;


use Base;
use DB\SQL;
use PDO;
use Template;

class InstallationController
{

    function showInstall()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        if (!$this->isInstalled()) {
            echo Template::instance()->render('installation/install.php');
        } else {
            echo "WorkTime ist already installed";
        }

    }

    function showUninstall()
    {
        if (!$this->isInstalled()) {
            echo "WorkTime ist not installed, goto /install to install WorkTime";
        } else {
            echo Template::instance()->render('installation/uninstall.php');
        }
    }

    function install()
    {
        /** @var \Base $f3 */
        $f3 = Base::instance();

        $host = $f3->get('POST.host');
        $user = $f3->get('POST.user');
        $pass = $f3->get('POST.pass');

        $this->createDBConfig($host, $user, $pass);
        $this->setupDatabase($host, $user, $pass);

        echo "Installation succeeded <a href='./'>Home</a>";

    }

    function uninstall()
    {

        /** @var \Base $f3 */
        $f3 = Base::instance();

        unlink('App/Config/db.cfg');
        $this->removeDatabase();
    }

    private function isInstalled()
    {
        return file_exists('App/Config/db.cfg');
    }

    private function createDBConfig($host, $user, $pass)
    {
        $cfg = fopen('App/Config/db.cfg', "w+");
        fwrite($cfg, "[globals]\n");
        fwrite($cfg, "DB_HOST={$host}\n");
        fwrite($cfg, "DB_NAME=worktimes\n");
        fwrite($cfg, "DB_USER={$user}\n");
        fwrite($cfg, "DB_PASS={$pass}\n");
        fclose($cfg);
    }

    private function removeDatabase()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        $sql = new SQL("mysql:host={$f3->get('DB_HOST')}", $f3->get('DB_USER'), $f3->get('DB_PASS'));
        $sql->exec("drop database {$f3->get('DB_NAME')}");
    }

    private function setupDatabase($host, $user, $pass)
    {
        $pdo = new PDO("mysql:host={$host}", $user, $pass);
        $pdo->exec(file_get_contents('db.sql'));
    }

}
