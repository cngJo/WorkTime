<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 18.03.2019
 * Time: 14:02
 */

namespace App\Controller;

use App\Models\TimesModel;
use App\Models\UserModel;

class ExportController extends Controller
{

    /**
     * Generates a csv file with all overtime entries from the logged in user
     */
    function overtime() {
        /** @var \Base $f3 */
        $f3 = \Base::instance();
        $user_id = $f3->get('SESSION.user_id');
        $userName = (new UserModel())->findone(['id=?', $user_id])->username;
        $csvContent = "Date;Minutes;Sign;Notes\r\n";

        $timesModel = new TimesModel();

        foreach ($timesModel->getTimes($user_id) as $time) {
            $csvContent .= "{$time->date};{$time->minutes};{$time->sign};{$time->notes}\r\n";
        }

        header("Content-Type: text/comma-separated-values");
        header ("Content-disposition: attachment; filename={$userName}_overtime.csv");
        echo $csvContent;
    }

    function userData() {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

    }

}
