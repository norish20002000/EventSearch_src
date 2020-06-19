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

    /**
     * diff timer
     */
    public static function getLeftTimer($nowTime, $stTime, $endTime)
    {
        $resultStr = "";
        $zeroTimeStr = "00:00:00";

        $now = new \DateTime($nowTime);
        $st = new \DateTime($stTime);
        $end = new \DateTime($endTime);

        $diff = ($now)->diff($st);

        $diffDays = $diff->format('%R%a');
// var_dump($now);
// var_dump($stTime);
// var_dump($diffDays);
// exit;
        if($diffDays == 0 && $now <= $st) {
            $resultStr = "開催まで " . $diff->format('%H:%I:%S');
        } elseif ($st->format('H:i:s') != $zeroTimeStr && $st <= $now && $now <= $end) {
            $resultStr = "開催中";
        } elseif ($end->format('H:i:s') != $zeroTimeStr && $end < $now) {
            $resultStr = "終了";
        } elseif (0 < $diffDays && $diffDays<= 7) {
            $resultStr = "開催まで " . \mb_substr($diffDays, 1, 1) . "日";
        }

        return $resultStr;
    }

}