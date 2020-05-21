<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Requests\EventFormSendRequest;
use App\Models\Event;
use App\Models\Genre;
use App\Models\GenreMap;

class EventBankController extends Controller
{
    /**
     * イベント編集画面
     */
    public function edit(Request $request, $id=0)
    {
        $data['event_data'] = new Collection();

        $data['genre'] = Genre::getGenre();

        if($id == 0) {
            $data['event_data']->status = 0;
            $data['event_data']->upType = 'register';
        } else {
            $data['event_data'] = Event::getEventDataByIdAllday($id);
            $data['event_data']->genre_id = GenreMap::getGenreId($id)->first();
            $data['event_data']->upType = 'update';
            // var_dump($data['event_data']->id);exit;
        }
        
// var_dump($data['event_data']->date);exit;
        // var_dump($data['genre']);exit;

        return view('edit/eventedit', $data);
    }

    /**
     * イベント登録
     */
    public function register(Request $request)
        // EventFormSendRequest $request)
    {
        // $this->validation($request);

        if($request->update) {
            $eventId = $request->event_id;
            Event::updateEventData($request);
        } elseif ($request->register) {
            $eventId = Event::saveEventData($request);
            GenreMap::saveGenreMap($eventId, $request);
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
        // var_dump($data['event_data']->date);exit;
// var_dump($data['event_data']);exit;
        return view('edit/eventopelist', $data);
    }

    public function getData(Request $request)
    {
        $data['event_data'] = Event::getEventDataAllday($request, $request->status);
        
        $data['status'] = $request->status;
        // $request->name;

        return $data;
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
