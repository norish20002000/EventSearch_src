<?php

namespace App\Http\Traits;

trait Csv {

    /**
     * make csv
     * @param string filePath
     * @param array header
     * @param array dataList
     * @param bool file削除flg
     * @return response
     */
    public static function csv($filePath, $header, $lists, $csvFlg=true) 
    {
        // リスト
        $lists = $lists;

        Csv::createCsv($filePath);

        // ヘッダー
        Csv::write($filePath, $header);

        // 値を入れる
        foreach ($lists as $list)
        {
            Csv::write($filePath, $list);
        }

        $response = file_get_contents($filePath);
        // ストリームに入れたら実ファイルは削除
        if ($csvFlg) {
            Csv::purge($filePath);
        }

        return response($response, 200)
                ->header('Content-Type', 'text/csv')
                ->header('Content-Disposition', 'attachment; filename='.\basename($filePath));
    }

    /**
     * CSVファイルを生成する
     * @param $filePath
     */ 
    public static function createCsv($filePath) {
        $result = fopen($filePath, 'w');
        if ($result === FALSE) {
            throw new Exception('ファイルの書き込みに失敗しました。');
        } else {
            fwrite($result, pack('C*',0xEF,0xBB,0xBF)); // BOM をつける
        }
        fclose($result);
    }

    /**
     * CSVファイルに書き出す
     * @param $filepath
     * @param $records
     */    
    public static function write($filepath, $records) {
        $result = fopen($filepath, 'a');

        // ファイルに書き出し
        // fputcsv($result, $records);
        $records = array_map(function($value){ return "\"$value\""; }, $records);
        $records = \implode(',', $records);
        $records .= $records . "\n";

        fwrite($result, $records);

        fclose($result);
    }

    /**
     * CSVファイルの削除
     * @param $filename
     */  
    public static function purge($filePath) {
        return unlink($filePath);
    }
}