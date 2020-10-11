<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventDate;
use App\Models\EventGenre;

class WelcomeController extends Controller
{
    /**
     * top画面表示
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        // $searchStr = trim(mb_ereg_replace('　', ' ', $request->search));
        // $request->searchList = [];
        // if (strpos($searchStr, ' ')){
        //     $request->searchList = explode(' ', $searchStr);
        // } elseif (strpos($searchStr, '　')) {
        //     $request->searchList = explode('　', $searchStr);
        // } else {
        //     $request->searchList[] = $searchStr;
        // }
        // var_dump($request->searchList);exit;

        // var_dump($request->all());exit;
        $searchType = "";

        if(isset($request->today)) {
            $data['event_data'] = self::searchToday($request);
            $searchType = "today";
        } elseif (isset($request->tomorrow)) {
            $data['event_data'] = self::searchTomorrow($request);
            $searchType = "tomorrow";
        } elseif (isset($request->weekend)) {
            $data['event_data'] = self::searchWeekend($request);
            $searchType = "weekend";
        } else {
            $data['event_data'] = Event::getEventFromToday($request);
            $searchType = $request->search ? "strSearch" : "";
        }

// var_dump($data['event_data']);exit;
        $data['event_data'] = Event::getGenreData($data['event_data']);

        $data['search'] = $request->search;
        $data['search_type'] = $searchType;

        return view("welcome", $data);
    }

    /**
     * request page
     */
    public function request(Request $request)
    {
        return view("request");
    }

    /**
     * company page
     */
    public function company(Request $request)
    {
        return view('company');
    }

    /**
     * today event
     * @param Request $request
     */
    private function searchToday($request)
    {
        $today = date("Y-m-d");
        $data['event_data'] = Event::getEventByDate($request, $today);

        return $data['event_data'];
    }

    /**
     * tomorrow event
     * @param Request $request
     */
    private function searchTomorrow($request)
    {
        $tomorrow = date("Y-m-d", strtotime('+1 day'));
        $data['event_data'] = Event::getEventByDate($request, $tomorrow);

        return $data['event_data'];
    }

    /**
     * weekend event
     */
    private function searchWeekend($request)
    {
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime('+1 day'));
        $nextSaturday = date("Y-m-d", strtotime('next Saturday'));
        $nextSunday = date("Y-m-d", strtotime('next Sunday'));
// var_dump(date('w'));exit;
        // weekday or suturday or sunday
        if (1 <= date('w') && date('w') <= 5) {
            $data['event_data'] = Event::getEventByDays($request, $nextSaturday, $nextSunday);
        } elseif (date('w') == 6) {
            $data['event_data'] = Event::getEventByDays($request, $today, $tomorrow);
        } elseif (date('w') == 0) {
            $data['event_data'] = Event::getEventByDate($request, $today);
        }

        return $data['event_data'];
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
