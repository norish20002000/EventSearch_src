<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $data['event_data'] = "";

        $data['genre'] = Genre::getGenre();

        if($id == 0) {
            return view('edit/eventedit', $data);
        } else {
            $data['event_data'] = Event::getEventDataById($id);
            $data['event_data']->genre_id = GenreMap::getGenreId($id)->first();
            // var_dump($data['event_data']->genre_id);exit;
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
        $eventId = Event::saveEventData($request);
        GenreMap::saveGenreMap($eventId, $request);

        // $request->session()->put('success',"イベントデータが保存されました。");

        return redirect()->route('eventedit')->with('success', "イベントデータが保存されました.");
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
