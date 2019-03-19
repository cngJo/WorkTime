<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 18.03.2019
 * Time: 09:12
 */

namespace App\Models;


use DB\SQL\Mapper;

class TimesModel extends Mapper
{
    public function __construct()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        parent::__construct($f3->get('DB'), 'times');
    }

    public function insertTime($date, $minutes, $sign, $notes, $user_id)
    {
        $this->user_id = $user_id;
        $this->sign = $sign;
        $this->minutes = $minutes;
        $this->date = $date;
        $this->notes = $notes;

        $this->save();
    }

    public function getTimes($user_id) {
        return $this->find(['user_id=?', $user_id]);
    }
}
