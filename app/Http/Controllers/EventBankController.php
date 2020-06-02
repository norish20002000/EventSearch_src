<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EventFormSendRequest;
use App\Models\Event;
use App\Models\Genre;
use App\Models\EventGenre;
use App\Models\Genre01;

class EventBankController extends Controller
{
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
            $eventId = $request->event_id;
            Event::updateEventData($request);
            self::saveImage($request, $eventId);
            // EventGenre::updateGenreMap($eventId, $request);
        } elseif ($request->register) {
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
