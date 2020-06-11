<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\EventFormSendRequest;
use App\Models\Event;
use App\Models\Genre;
use App\Models\EventGenre;
use App\Models\Genre01;
use App\Models\EventDate;
use App\Http\Traits\Csv;

use ZipArchive;

class EventBankController extends Controller
{
    use Csv;

    /**
     * イベント編集画面
     */
    public function edit(Request $request, $id=0)
    {
        $data['event_data'] = new Event();

        $data['genre'] = Genre::getGenre();
        $data['genre01List'] = Genre01::getGenre01()->groupBy("genre_id");

        // for genre disp_name
        foreach($data['genre01List'] as $key=>$genre) {
            $genre->genre01 = $data['genre']->where('id', $key)->first();
        }

        if($id == 0) {
            $data['event_data']->status = 0;
            $data['event_data']->upType = 'register';
        } else {
            $data['event_data'] = Event::getEventDataByIdAllday($id);
            
            // get genre01
            $data['genre01s'] = $data['event_data']->genre01s;

            $data['event_data']->genre = EventGenre::getGenreId($id)->first();
            $data['event_data']->upType = 'update';

            //　時間変換
            $data['event_data']->st_time = mb_substr($data['event_data']->st_time, 0, 5);
            $data['event_data']->end_time = mb_substr($data['event_data']->end_time, 0, 5);
            $data['event_data']->st_time_h = mb_substr($data['event_data']->st_time, 0, 2);
            $data['event_data']->st_time_m = mb_substr($data['event_data']->st_time, 3, 2);
            $data['event_data']->end_time_h = mb_substr($data['event_data']->end_time, 0, 2);
            $data['event_data']->end_time_m = mb_substr($data['event_data']->end_time, 3, 2);

            // var_dump($data['event_data']->st_time_h);exit;
        }

        // image
        $data['event_data']->image_flg = $this->checkImage($id);
        // dir
        $data['event_data']->dir = config('app.DIR');
        // var_dump($data['event_data']);exit;

        return view('edit.eventedit', $data);
    }

    /**
     * イベント登録
     */
    public function register(
        // Request $request)
        EventFormSendRequest $request)
    {
        // $this->validation($request);
        if($request->update) {
            // time marge
            $request = $this->makeTimeFromHM($request);

            $eventId = $request->event_id;
            Event::updateEventData($request);
            self::saveImage($request, $eventId);
            // EventGenre::updateGenreMap($eventId, $request);
        } elseif ($request->register) {
            // time marge
            $request = $this->makeTimeFromHM($request);

            $eventId = Event::saveEventData($request);
            self::saveImage($request, $eventId);
            // EventGenre::saveGenreMap($eventId, $request);
        } elseif ($request->copyevent) {
            $eventId = $this->copyEventData($request);
        }

        // $request->session()->put('success',"イベントデータが保存されました。");

        return redirect()->route('eventedit', ['id' => $eventId])->with('success', "イベントデータが保存されました.");
    }

    /**
     * 時間変換
     */
    private function makeTimeFromHM($request)
    {
        $request['st_time'] = $request->st_time_h ? $request->st_time_h . ":" . $request->st_time_m : null;
        $request['end_time'] = $request->end_time_h ? $request->end_time_h . ":" . $request->end_time_m : null;

        return $request;
    }

    /**
     * csv
     */
    public function exportCsv(Request $request)
    {


        return view('edit.eventexport');
    }

    public function exportCsvList(Request $request)
    {
        $eventIdList = EventDate::getBetween($request->st_date, $request->end_date)->pluck("event_id")->unique();
        $eventData = Event::getEventWithGenreAndGenre01($eventIdList);
        // $columns = Schema::getColumnListing('events');
        // var_dump($columns);exit;

        $csvList = [];
        $fileList = [];
        $replacePatterns = ["\n", "\r\n", "\r", "\t"];
        foreach($eventData as $key => $event) {

            // image filepath
            if($event->image_url) {
                $extension = \pathinfo($event->image_url)['extension'];
                $fileList[] = public_path("storage/event_images/$event->id/$event->id.$extension");
            }

            $dayList = [];
            $genreList = [];
            $genre01List = [];
            foreach ($event->event_dates as $date) {
                $dayList[] = $date->event_date;
            }
            foreach ($event->genres as $genre) {
                $genreList[] = $genre->disp_name;
            }
            foreach ($event->genre01s as $genre01) {
                $genre01List[] = $genre01->disp_name;
            }

            $csvList[] = [
                            $event->id,
                            $event->title,
                            \str_replace($replacePatterns, '', $event->introduction),
                            \mb_substr($event->st_time, 0, 5),
                            \mb_substr($event->end_time, 0, 5),
                            $event->summary_date,
                            $event->web_name,
                            $event->web_url,
                            $event->fee_type,
                            $event->fee,
                            basename($event->image_url),
                            $event->reference_name,
                            $event->reference_url,
                            $event->release_date,
                            $event->regi_group_name,
                            $event->regi_name,
                            $event->regi_tel,
                            $event->regi_mail,
                            $event->status,
                            $event->created_at,
                            $event->created_at,
                            \implode(',', $dayList),
                            \implode(',', $genreList),
                            \implode(',', $genre01List),
                        ];
        }
        // var_dump($csvList);exit;

        $header = [
            'ID',
            'イベント名',
            '紹介文',
            '開始時刻',
            '終了時刻',
            '日時備考',
            '視聴サイト名',
            '視聴URL',
            '料金種別',
            '料金',
            '画像ファイル名',
            '参考サイト名',
            '参考URL',
            '公開日',
            '登録者団体名',
            '登録者担当者名',
            '登録者電話番号',
            '登録者メールアドレス',
            'ステータス',
            'created_at',
            'updated_at',
            'days',
            '大カテゴリ',
            '小カテゴリ'
            ];

        $filename = "event".date('Ymd').".csv";
        $filePath = storage_path('app/'.$filename);
        $csv = Csv::csv($filePath, $header, $csvList, false);

        // zip
        $zipFileName = "event_" . date('Ymd') . ".zip";
        $zipDir = storage_path('app/');
        $zip = new ZipArchive();
        $zip->open($zipDir.$zipFileName, ZipArchive::CREATE | ZIPARCHIVE::OVERWRITE);

        // add csv to zip
        $zip->addFromString(basename($filePath), file_get_contents($filePath));

        foreach ($fileList as $file) {
            $imageFileName = basename($file);
 
            // add image to zip
            $zip->addFromString("images/" . $imageFileName, file_get_contents($file));
            // $zip->addFile($file);
        }

        $zip->close();

        // ストリームに出力
        header('Content-Type: application/zip; name="' . $zipFileName . '"');
        header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
        header('Content-Length: '.filesize($zipDir.$zipFileName));
        echo file_get_contents($zipDir.$zipFileName);
  
        // 一時ファイルを削除しておく
        unlink($zipDir.$zipFileName);
        Csv::purge($filePath);
    
        ob_end_clean();

        // header('Content-Type: application/octet-stream');
        // header('Content-Length: '.filesize($filepath));
        // header('Content-Disposition: attachment; filename='.$filename);
         
        // // ファイル出力
        // readfile($filepath);
    }

    /**
     * image save
     */
    private static function saveImage($request, $eventId)
    {
        if($request->event_image) {
            // image folder作成
            if(!Storage::exists(config('app.DIR.EVENT_IMAGE_PUBLIC') . $eventId)) {
                $result = Storage::makeDirectory(config('app.DIR.EVENT_IMAGE_PUBLIC') . $eventId, 0775, true);
            }

            $request->event_image->storeAs(config('app.DIR.EVENT_IMAGE_PUBLIC') . $eventId, $eventId . '.jpg');
        }

        // delete image
        if(!$request->image_data) {
            if(Storage::exists(config('app.DIR.EVENT_IMAGE_PUBLIC') . $eventId . "/$eventId.jpg")) {

                $result = Storage::delete(config('app.DIR.EVENT_IMAGE_PUBLIC') . $eventId . "/$eventId.jpg");

                // events.image_url update to null
                $result = Event::deleteImageUrl($request, $eventId);
            }
        }
    }

    /**
     * image check
     */
    private function checkImage($event_id) {
        if(Storage::disk('local')->exists(config('app.DIR.EVENT_IMAGE_PUBLIC') . "$event_id/$event_id.jpg")) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 
     */
    private function validation($request)
    {
        $this->validate($request, [
            'title' => 'required',
        ],
        [

        ],[
            'title' => 'タイトル',
        ]);

    }

    /**
     * 
     */
    public function showList(Request $request)
    {
        $data['event_data'] = Event::getEventDataAllday($request, 1);

        return view('edit.eventopelist', $data);
    }

    public function getData(Request $request)
    {
        $data['event_data'] = Event::getEventDataAllday($request, $request->status);
        
        $data['status'] = $request->status;

        return $data;
    }

    /**
     * replicate event data
     */
    public function copyEventData(Request $request)
    {
        $preEvent = Event::find($request->event_id);
        $event = $preEvent->replicate();
        $event->image_url = null;

        DB::transaction(function () use ($event, $request){
            $event->save();

            // genre_map insert
            // $result = EventGenre::saveGenreMap($event->id, $request);
        });

        return $event->id;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
}
