<?php
namespace app\Libs;

class Utility {

    /**
     * 曜日変換
     * @param date $date
     * @return string weekStr
     */
    public static function getWeekStr($date)
    {
        $weekList = ["日", "月", "火", "水", "木", "金", "土"];
        $weekStr = $weekList[date('w', strtotime($date))];

        return $weekStr;
    }

}