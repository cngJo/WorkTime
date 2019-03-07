<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 20.02.2019
 * Time: 08:36
 */

namespace App\Controller;


use App\Models\UserModel;
use Base;
use DB\SQL;
use PDO;
use Template;

class InstallationController
{

    /**
     * This function gets called, when the user enters /install
     *   - check if WorkTime is installed
     *   - when not, render the installation/install template
     *   - else print s info text to the user
     */
    function showInstall()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        if (!$this->isInstalled()) {
//            $f3->set('languages', $f3->get('languages'));
            echo Template::instance()->render('installation/install.php');
        } else {
            // todo: change to template
            echo "WorkTime ist already installed";
        }

    }

    /**
     * This function gets called, when the user enters /uninstall
     *   - check if WorkTime is installed
     *   - when not, render the installation/uninstall template
     *   - else print s info text to the user
     */
    function showUninstall()
    {
        if (!$this->isInstalled()) {
            echo "WorkTime ist not installed, goto /install to install WorkTime";
        } else {
            echo Template::instance()->render('installation/uninstall.php');
        }
    }

    /**
     * This function gets called, when the user submits the form in the installation/install view
     *   - temp save the form parameters
     *   - create the db config file to store the DB Configurations
     *   - setup the database
     */
    function install()
    {
        /** @var \Base $f3 */
        $f3 = Base::instance();

        $host = $f3->get('POST.host');
        $user = $f3->get('POST.user');
        $pass = $f3->get('POST.pass');
        $lang = $f3->get('POST.lang');

        $this->createSetupConfig($host, $user, $pass, $lang);
        $this->setupDatabase($host, $user, $pass);

        echo "Installation succeeded <a href='./'>Home</a>";

    }

    /**
     * This function gets called, when the user submits the form in the installation/uninstall view
     *   - unlink (delete) the db config file
     *   - remove the database from the server
     */
    function uninstall()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        unlink('App/Config/installation.cfg');
        $this->removeDatabase();
        $f3->reroute('/');
    }

    /**
     * checks if WorkTime is installed, by checking if the installation.cfg file exists
     *   - returns true if file exists (WorkTime is installed)
     *   - returns false if file does not exists (WorkTime is not installed)
     *
     * @return bool
     */
    private function isInstalled()
    {
        return file_exists('App/Config/installation.cfg');
    }

    /**
     * Creates the db config file
     *
     * @param $host
     * @param $user
     * @param $pass
     */
    private function createSetupConfig($host, $user, $pass, $lang)
    {
        $cfg = fopen('App/Config/installation.cfg', "w+");
        fwrite($cfg, "[globals]\n");
        fwrite($cfg, "DB_HOST={$host}\n");
        fwrite($cfg, "DB_NAME=worktimes\n");
        fwrite($cfg, "DB_USER={$user}\n");
        fwrite($cfg, "DB_PASS={$pass}\n");
        fwrite($cfg, "LANG={$lang}\n");
        fclose($cfg);
    }

    /**
     * removes (drops) the database, configured in the db config file
     */
    private function removeDatabase()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        $sql = new SQL("mysql:host={$f3->get('DB_HOST')}", $f3->get('DB_USER'), $f3->get('DB_PASS'));
        $sql->exec("drop database {$f3->get('DB_NAME')}");
    }

    /**
     * setup the database by executing the db.sql script on the configured database server
     *
     * @param $host
     * @param $user
     * @param $pass
     */
    private function setupDatabase($host, $user, $pass)
    {
        $pdo = new PDO("mysql:host={$host}", $user, $pass);
        $pdo->exec(file_get_contents('db.sql'));
    }

    /**
     * This function creates an admin user with the given credentials in the database
     *
     * @param $username
     * @param $password
     * @param $email
     */
    private function ceateAdminUser($username, $password, $email)
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();
        $userModel = new UserModel();

        if ($userModel->checkCredentials($username, $password, $email)) {
            $userModel->username=$username;
            $userModel->password = $userModel->hash
        }
    }

}
