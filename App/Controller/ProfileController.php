<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 11.03.2019
 * Time: 12:15
 */

namespace App\Controller;


use App\Models\UserModel;
use App\Overtime;
use Template;

class ProfileController extends Controller
{

    function showProfile()
    {
        $this->userProfile();
    }

    private function adminProfile()
    {

    }

    private function userProfile()
    {
        $f3 = \Base::instance();
        $userModel = new UserModel();

        $user = $userModel->isLoggedIn();


        if ($user) {
            $user = $userModel->findone(['id=?', $user]);

            // load Overtime
            $overtime = Overtime::getOvertime($user->id);
            $time = Overtime::fixNumber(Overtime::minutesToHours($overtime['allMinutes'])['hours']) . '.' . Overtime::fixNumber(Overtime::minutesToHours($overtime['allMinutes'])['minutes']);

            $AllMinutes = $overtime['AllMinutes'];
            $times = $overtime['times'];

            // load user data for the profile
            $f3->set('user.username', $user->username);
            $f3->set('user.email', $user->email);
            $f3->set('user.role', $user->role);
            $f3->set('user.overtime.sign', '');
            $f3->set('user.overtime', [
                'time' => $time,
                'sign' => $AllMinutes < 0 ? '-' : '',
                'color' => $AllMinutes < 0 ? 'red' : 'green'
            ]);

            echo Template::instance()->render('profile.php');
        } else {
            die("you have to <a href='login'>Login</a> to see your profile");
        }
    }

}
