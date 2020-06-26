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
// var_dump($st);
// var_dump($diffDays);
// exit;
        if($st->format('H:i:s') != $zeroTimeStr && $diffDays == 0 && $now <= $st) {
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

    /**
     * url Encode RFC 3986
     * @param string $string
     * @return string 
     */
    public static function myUrlEncode($string) {
        $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
        $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");

        return str_replace($entities, $replacements, urlencode($string));
    }
}