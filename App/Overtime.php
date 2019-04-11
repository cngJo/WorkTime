<?php

namespace App;

use Base;
use DB\SQL\Mapper;

class Overtime
{

    /**
     * load the overtime from the user with the given id
     *
     * @param $user_id
     * @return mixed
     */
    public static function getOvertime($user_id)
    {
        $f3 = Base::instance();

        $table = new Mapper($f3->get('DB'), 'times');
        $data = $table->find(['user_id=?', $user_id]);

        $data = $f3->get('DB')->exec("select * from times where user_id={$user_id} and active=1 "); // select * from times where user_id = '' and active = 1

        $result = [
            'allMinutes' => 0,
            'times' => []
        ];

        foreach ($data as $time) {

            // add or subtract the minutes from the database of allMinutes according to the sign
            if ($time['sign'] === '+') {
                $result['allMinutes'] += $time['minutes'];
            } else {
                $result['allMinutes'] -= $time['minutes'];
            }

            $hours = self::minutesToHours($time['minutes'])['hours'];
            $minutes = self::minutesToHours($time['minutes'])['minutes'];

            // fix numbers
            $hours = self::fixNumber($hours);
            $minutes = self::fixNumber($minutes);

            array_push($result['times'], [
                'sign' => $time['sign'],
                'time' => "{$hours}.{$minutes}",
                'color' => $time['sign'] === '+' ? 'green' : 'red',
                'date' => $time['date'],
                'note' => $time['notes'],
                'id' => $time['id'],
            ]);
        }

        return $result;
    }

    /**
     * converts minutes in hours and minutes (150min = 2h30min)
     *   - return as assoc array
     *
     * @param $mins
     * @return array
     */
    public static function minutesToHours($mins)
    {
        $hours = 0;
        $minutes = 0;

        if (self::removeSign($mins) < 60) {
            $minutes = self::removeSign($mins);
        } else {
            $minutes = self::removeSign($mins);
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
     * Fixing numbers, so we always have two digits
     *   - if one digit, add 0 in front of number
     *   - if more than 2 digits, only return the first two digits
     *
     * @param $number
     * @return string
     */
    public static function fixNumber($number)
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
    public static function removeSign($number)
    {
        $arr = str_split($number);
        if ($arr[0] == '+' || $arr[0] == '-') {
            array_shift($arr);
        }
        return implode($arr);
    }

}
