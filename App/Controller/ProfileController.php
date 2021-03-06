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
        $f3 = \Base::instance();
        $userModel = new UserModel();
        $user = $userModel->isLoggedIn();

        if ($user) {
            if ($userModel->isAdmin($user)) {
                $this->adminProfile();
            } else {
                $this->userProfile();
            }
        } else {
            echo Template::instance()->render('pages/notLoggedIn.php');
        }
    }

    private function adminProfile()
    {
        $f3 = \Base::instance();
        $userModel = new UserModel();
        $users = [];

        $LoggedInUser = $userModel->isLoggedIn();

        $LoggedInUser = $userModel->findone(['id=?', $LoggedInUser]);
        $overtime = Overtime::getOvertime($LoggedInUser->id);
        $time = Overtime::fixNumber(Overtime::minutesToHours($overtime['allMinutes'])['hours']) . '.' . Overtime::fixNumber(Overtime::minutesToHours($overtime['allMinutes'])['minutes']);
        $f3->set('loggedInUser', [
            'username' => $LoggedInUser->username,
            'email' => $LoggedInUser->email,
            'role' => $LoggedInUser->role,
            'overtime' => [
                'time' => $time,
                'sign' => $overtime['allMinutes'] < 0 ? '-' : '',
                'color' => $overtime['allMinutes'] < 0 ? 'red' : 'green'
            ]
        ]);

        foreach ($userModel->select('*') as $user) {
            $overtime = Overtime::getOvertime($user->id);
            $time = Overtime::fixNumber(Overtime::minutesToHours($overtime['allMinutes'])['hours']) . '.' . Overtime::fixNumber(Overtime::minutesToHours($overtime['allMinutes'])['minutes']);

            array_push($users, [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role,
                'overtime' => [
                    'time' => $time,
                    'sign' => $overtime['allMinutes'] < 0 ? '-' : '',
                    'color' => $overtime['allMinutes'] < 0 ? 'red' : 'green'
                ]
            ]);
        }

        $f3->set('users', $users);
        $f3->set('isAdmin', 'true');
        $f3->set('user.name', $LoggedInUser->username);
        $f3->set('SESSION.user_id', $userModel->isLoggedIn());
        echo Template::instance()->render('profile.php');
    }

    private function userProfile()
    {
        $f3 = \Base::instance();
        $userModel = new UserModel();

        $user = $userModel->isLoggedIn();

        $user = $userModel->findone(['id=?', $user]);

        // load Overtime
        $overtime = Overtime::getOvertime($user->id);
        $time = Overtime::fixNumber(Overtime::minutesToHours($overtime['allMinutes'])['hours']) . '.' . Overtime::fixNumber(Overtime::minutesToHours($overtime['allMinutes'])['minutes']);

        $AllMinutes = $overtime['AllMinutes'];
        $times = $overtime['times'];

        // load user data for the profile
        $f3->set('loggedInUser', [
           'username' => $user->username,
           'email' => $user->email,
           'role' => $user->role,
           'overtime' => [
               'time' => $time,
               'sign' => $AllMinutes < 0 ? '-' : '',
               'color' => $AllMinutes < 0 ? 'red' : 'green'
           ]
        ]);
        $f3->set('isAdmin', 'false');
        $f3->set('user.name', $user->username);
        echo Template::instance()->render('profile.php');
    }

}
