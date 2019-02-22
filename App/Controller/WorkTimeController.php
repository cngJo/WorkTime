<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 19.02.2019
 * Time: 09:47
 */

namespace App\Controller;


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

            $table = new Mapper(self::getDB(), 'times');
            $data = $table->find();

            $AllMinutes = 0;

            $times = array();

            foreach ($data as $time) {

                // add or subtract the minutes from the database of AllMinutes according to the sign
                if ($time->sign === '+') {
                    $AllMinutes += $time->minutes;
                } else {
                    $AllMinutes -= $time->minutes;
                }

                $hours = $this->minutesToHours($time->minutes)['hours'];
                $minutes = $this->minutesToHours($time->minutes)['minutes'];

                array_push($times, [
                    'sign' => $time->sign,
                    'time' => "{$this->fixNumber($hours)}.{$this->fixNumber($minutes)}",
                    'color' => $time->sign === '+' ? 'green' : 'red',
                    'date' => $time->date,
                    'note' => $time->notes
                ]);
            }

            $f3->set('times', $times);
            $f3->set('allTime', [
                'time' => "{$this->fixNumber($this->minutesToHours($AllMinutes)['hours'])}.{$this->fixNumber($this->minutesToHours($AllMinutes)['minutes'])}",
                'sign' => $AllMinutes < 0 ? '-' : '',
                'color' => $AllMinutes < 0 ? 'red' : 'green'
            ]);

            echo Template::instance()->render('layout.php');
        } else {
            echo "WorkTime ist not installed <a href='install'>Install WorkTime</a>";
        }

    }

    function get()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        if ($this->isInstalled()) {
            $f3->set('type', 'get');

            echo \Template::instance()->render('edit.php');
        } else {
            echo "WorkTime ist not installed";
        }

    }

    function take()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();
        if ($this->isInstalled()) {
            $f3->set('type', 'take');

            echo \Template::instance()->render('edit.php');
        } else {
            echo "WorkTime ist not installed";
        }

    }

    /**
     * Fixing numbers, so we always have two digits
     *   - if one digit, add 0 in front of number
     *   - if more than 2 digits, only return the first two digits
     *
     * @param $number
     * @return string
     */
    private function fixNumber($number)
    {
        if (strlen($number) == 1) {
            return "0{$number}";
        } else if (strlen($number) > 2) {
            $numberArr = str_split($number);
            return "{$numberArr[0]}{$numberArr[1]}";
        } else {
            return $number;
        }
    }

    /**
     * Checks if the first char is either + or - and if, it removes them
     *
     * @param $number
     * @return string
     */
    private function removeSign($number)
    {
        $arr = str_split($number);
        if ($arr[0] == '+' || $arr[0] == '-') {
            array_shift($arr);
        }
        return implode($arr);
    }

    /**
     * converts minutes in hours and minutes (150min = 2h30min)
     *   - return as assoc array
     *
     * @param $mins
     * @return array
     */
    private function minutesToHours($mins)
    {
        $hours = 0;
        $minutes = 0;

        if ($this->removeSign($mins) < 60) {
            $minutes = $this->removeSign($mins);
        } else {
            $minutes = $this->removeSign($mins);
            while ($minutes >= 60) {
                $hours++;
                $minutes -= 60;
            }
        }

        return [
            'minutes' => $minutes,
            'hours' => $hours,
        ];
    }

    /**
     * Checks if WorkTime is installed by checking if the db config files exists
     * @return bool
     */
    private function isInstalled()
    {
        return file_exists('App/Config/installation.cfg');
    }

}
