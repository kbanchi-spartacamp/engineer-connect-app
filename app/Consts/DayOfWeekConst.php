<?php

namespace App\Consts;

class DayOfWeekConst
{
    const SUNDAY = 1;
    const MONDAY = 2;
    const TUESDAY = 3;
    const WEDNESDAY = 4;
    const THURSDAY = 5;
    const FRIDAY = 6;
    const SATURDAY = 7;
    const DAY_OF_WEEK_LIST = [
        '日曜' => self::SUNDAY,
        '月曜' => self::MONDAY,
        '火曜' => self::TUESDAY,
        '水曜' => self::WEDNESDAY,
        '木曜' => self::THURSDAY,
        '金曜' => self::FRIDAY,
        '土曜' => self::SATURDAY,
    ];
    const DAY_OF_WEEK_LIST_EN = [
        'Sun' => self::SUNDAY,
        'Mon' => self::MONDAY,
        'Tue' => self::TUESDAY,
        'Wed' => self::WEDNESDAY,
        'Thu' => self::THURSDAY,
        'Fri' => self::FRIDAY,
        'Sat' => self::SATURDAY,
    ];
}
