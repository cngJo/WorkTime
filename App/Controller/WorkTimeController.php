<?php

namespace App\Controller;


use App\Models\UserModel;
use App\Overtime;
use Base;
use DB\SQL\Mapper;
use Template;

class WorkTimeController extends Controller
{

    /**
     * This function gets called, when the user access the main route
     *   - checks if WorkTime is installed
     *   - gets all entries from the database and stores the values as an assoc array in $times
     *   - calculates the amount of minutes from all entries and convert them in hh.mm, when time is negative we add an minus sign
     */
    function index()
    {
        $f3 = Base::instance();

        if ($this->isInstalled()) {

            $userModel = new UserModel();

            $loggedInUser = $userModel->isLoggedIn();

            if (!$loggedInUser) {
                echo Template::instance()->render('pages/notLoggedIn.php');
            } else {

                $table = new Mapper(self::getDB(), 'times');
                $data = $table->find(['user_id=?', $loggedInUser]);

                $overtime = Overtime::getOvertime($loggedInUser);

                $AllMinutes = $overtime['allMinutes'];
                $times = $overtime['times'];

                $time = Overtime::fixNumber(Overtime::minutesToHours($overtime['allMinutes'])['hours']) . '.' . Overtime::fixNumber(Overtime::minutesToHours($overtime['allMinutes'])['minutes']);
                $f3->set('times', $times);
                $f3->set('allTime', [
                    'time' => $time,
                    'sign' => $AllMinutes < 0 ? '-' : '',
                    'color' => $AllMinutes < 0 ? 'red' : 'green'
                ]);
                $f3->set('user.name', $userModel->findone(array('id=?', $loggedInUser))->username);
                $f3->set('user.isLoggedIn', 'true');
                echo Template::instance()->render('layout.php');
            }
        } else {
            echo "WorkTime ist not installed <a href='install'>Install WorkTime</a>";
        }

    }

    function get()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        if ($this->isInstalled()) {

            $userModel = new UserModel();

            $loggedInUser = $userModel->isLoggedIn();

            if (!$loggedInUser) {
                die("you have to <a href='login'>login</a>");
            } else {
                $f3->set('type', 'get');
                $f3->set('user_id', $loggedInUser);
                $f3->set('user.name', $userModel->findone(array('id=?', $loggedInUser))->username);
                echo \Template::instance()->render('edit.php');
            }
        } else {
            echo "WorkTime ist not installed";
        }

    }

    function take()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();
        if ($this->isInstalled()) {

            $userModel = new UserModel();

            $loggedInUser = $userModel->isLoggedIn();

            if (!$loggedInUser) {
                die("you have to <a href='login'>login</a>");
            } else {
                $f3->set('type', 'take');
                $f3->set('user_id', $loggedInUser);
                $f3->set('user.name', $userModel->findone(array('id=?', $loggedInUser))->username);
                echo \Template::instance()->render('edit.php');
            }
        } else {
            echo "WorkTime ist not installed";
        }

    }

}
