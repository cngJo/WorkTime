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

    function index()
    {
        $f3 = Base::instance();

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
                'date' => $time->date
            ]);
        }

        $f3->set('times', $times);
        $f3->set('allTime', [
            'time' => "{$this->fixNumber($this->minutesToHours($AllMinutes)['hours'])}.{$this->fixNumber($this->minutesToHours($AllMinutes)['minutes'])}",
            'sign' => $AllMinutes < 0 ? '-' : '',
            'color' => $AllMinutes < 0 ? 'red' : 'green'
        ]);

        echo Template::instance()->render('layout.php');
    }

    function get()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        $f3->set('type', 'get');

        echo \Template::instance()->render('edit.php');

    }

    function take()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        $f3->set('type', 'take');

        echo \Template::instance()->render('edit.php');

    }

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

    private function removeSign($number)
    {
        $arr = str_split($number);
        if ($arr[0] == '+' || $arr[0] == '-') {
            array_shift($arr);
        }
        return implode($arr);
    }

    function minutesToHours($mins)
    {
        $hours = 0;
        $minutes = 0;

        if ($this->removeSign($mins) < 60) {
            $minutes = $this->removeSign($mins);
        } else {
            $minutes = $this->removeSign($mins);
            while ($minutes > 60) {
                $hours++;
                $minutes -= 60;
            }
        }

        return [
            'minutes' => $minutes,
            'hours' => $hours,
        ];
    }

}
