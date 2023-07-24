<?php

namespace App\Utils;

use Illuminate\Support\Carbon;

class DatesConfigure
{
    //get the next and the previous
    public function getNextPreviousDate($month,$day ){

        $date = Carbon::createFromDate(2020, $month, $day); // 2020 in order to enable 29.2 date data
        $next_day = $date->copy()->addDay()->format('d');
        $next_month = $date->copy()->addDay()->format('m');
        $prev_day = $date->copy()->subDay()->format('d');
        $prve_month = $date->copy()->subDay()->format('m');

        $nextAndPreviosDates = [
            'next_day' => $next_day,
            'next_month' => $next_month,
            'previous_day' => $prev_day,
            'previous_month' => $prve_month,
        ];

        return $nextAndPreviosDates;
    }

}
