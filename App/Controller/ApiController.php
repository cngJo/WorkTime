<?php
/**
 * Created by PhpStorm.
 * User: LocalAdmin
 * Date: 19.02.2019
 * Time: 13:38
 */

namespace App\Controller;


use DB\SQL\Mapper;

class ApiController extends Controller
{

    function get()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        $table = new Mapper(self::getDB(), 'times');
        $table->sign = '+';
        $table->minutes = ($f3->get('POST.hours') * 60) + $f3->get('POST.minutes');
        $table->date = $f3->get('POST.date');
        $table->notes = $f3->get('POST.notes');
        $table->user_id = $f3->get('POST.user_id');
        $table->save();

        $f3->reroute('/');
    }

    function take()
    {
        /** @var \Base $f3 */
        $f3 = \Base::instance();

        $table = new Mapper(self::getDB(), 'times');
        $table->sign = '-';
        $table->minutes = ($f3->get('POST.hours') * 60) + $f3->get('POST.minutes');
        $table->date = $f3->get('POST.date');
        $table->notes = $f3->get('POST.notes');
        $table->user_id = $f3->get('POST.user_id');
        $table->save();

        $f3->reroute('/');
    }

    function remove($_, $params)
    {
        $f3 = \Base::instance();

        $table = new Mapper(self::getDB(), 'times');
        $table->load(['id=?', $params['id']]);
        $table->active=0;
        $table->save();

        $f3->reroute('/');
    }
}
