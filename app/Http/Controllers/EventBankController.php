<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
        $data['event_data'] = new Collection();

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
            // EventGenre::updateGenreMap($eventId, $request);
        } elseif ($request->register) {
            $eventId = Event::saveEventData($request);
            // EventGenre::saveGenreMap($eventId, $request);
        } elseif ($request->copyevent) {
            $eventId = $this->copyEventData($request);
        }

        // $request->session()->put('success',"イベントデータが保存されました。");

        return redirect()->route('eventedit', ['id' => $eventId])->with('success', "イベントデータが保存されました.");
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
