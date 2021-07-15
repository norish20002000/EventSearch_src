<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;
use ZipArchive;


class CsvEventBankController extends Controller
{
    public static function importCsvEventBankPress(){
        // 関連テーブル全件削除
        Event::deleteAllEventsRelation();

        self::insertCsvData();
        self::saveImage();
    }

    private static function insertCsvData() {
        $url = env('EVENT_CSV_URL');
        $user = env('EVENT_CSV_ID');
        $pass = env('EVENT_CSV_PASS');

        $options =  [
            'http' => [
                'method' => 'GET',
                'header' => 'Authorization: Basic ' . base64_encode($user . ':' . $pass)
            ]
        ];
        
        $data = file_get_contents($url, false, stream_context_create($options));
        $fileName = "eventData.csv";
        $filePath = \storage_path('app/') . $fileName;
        file_put_contents($filePath, $data);

        $file = new \SplFileObject($filePath);
        $file->setFlags(
            \SplFileObject::READ_CSV |
            \SplFileObject::READ_AHEAD |
            \SplFileObject::SKIP_EMPTY |
            \SplFileObject::DROP_NEW_LINE
        );

        // herder
        // "event_id","event_name","catchcopy","article","pic_path","pic_height","pic_copyright","fee_class","fee_text","viewer","view_site","view_url","ref_site","ref_url","start_time_h","start_time_m","end_time_h","end_time_m","time_text","release_y","release_m","release_d","category","reg_date","update_date","days"
        $header = [];
        foreach ($file as $row) {
            if (empty($header)) {
                $header = $row;
                continue;
            }

            Event::insertEventsDb($row);
            
            // var_dump($item);
        }

        \unlink($filePath);
    }

    /**
     * save image
     */
    private static function saveImage() {
        $url = env('EVENT_IMG_URL');
        $user = env('EVENT_CSV_ID');
        $pass = env('EVENT_CSV_PASS');

        $options =  [
            'http' => [
                'method' => 'GET',
                'header' => 'Authorization: Basic ' . base64_encode($user . ':' . $pass)
            ]
        ];
        
        $data = file_get_contents($url, false, stream_context_create($options));
        $fileName = "eventImgData.zip";
        $filePath = \storage_path('app/') . $fileName;
        file_put_contents($filePath, $data);

        $tempDir = "tempImg/";
        $to = \storage_path('app/') . $tempDir;
        $zip = new ZipArchive();
        $res = $zip->open($filePath);

        if($res === true){
            $zip->extractTo($to);
            $zip->close();
        } else {
            echo 'Error Code: ' . $res;
        }

        // var_dump(Storage::files($tempDir));exit;

        $imgDir = config('app.DIR.EVENT_IMAGE_PUBLIC');

        // 既存img削除
        Storage::deleteDirectory($imgDir);
        Storage::makeDirectory($imgDir);

        foreach (Storage::files($tempDir) as $imgFile) {
            $id = basename($imgFile, ".jpg");
            $imgName = basename($imgFile);

            if (!Storage::exists($imgDir . $id)){
                $result = Storage::makeDirectory($imgDir . $id, 0775, true);
            }

            if (!Storage::exists($imgDir . $id . "/" . $imgName)) {
                Storage::copy($tempDir.$imgName, $imgDir . $id . "/" . $imgName);
            } else {
                Storage::delete($imgDir . $id . "/" . $imgName);
                Storage::copy($tempDir.$imgName, $imgDir . $id . "/" . $imgName);
            }
        }

        Storage::deleteDirectory($tempDir);
        // Storage::makeDirectory($tempDir);
        Storage::delete($fileName);
    }

    public function __invoke($x)
    {
        var_dump($x);
    }
}
