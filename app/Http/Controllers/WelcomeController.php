<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class WelcomeController extends Controller
{
    /**
     * top画面表示
     * @param Request $request
     * @return view
     */
    public function index(Request $request)
    {
        $data['event_data'] = Event::getEventData($request);
        $data['search'] = $request->search;

        return view("welcome", $data);
    }

    /**
     * today event
     * @param Request $request
     */
    public function searchToday(Request $request)
    {
        $today = date("Y-m-d");
        $data['event_data'] = Event::getEventByDate($request, $today);

        return view("welcome", $data);
    }

    /**
     * tomorrow event
     * @param Request $request
     */
    public function searchTomorrow(Request $request)
    {
        $tomorrow = date("Y-m-d", strtotime('+1 day'));
        $data['event_data'] = Event::getEventByDate($request, $tomorrow);

        return view("welcome", $data);
    }

    /**
     * weekend event
     */
    public function searchWeekend(Request $request)
    {
        $today = date("Y-m-d");
        $tomorrow = date("Y-m-d", strtotime('+1 day'));
        $nextSaturday = date("Y-m-d", strtotime('next Saturday'));
        $nextSunday = date("Y-m-d", strtotime('next Sunday'));

        // weekdat or suturday or sunday
        if (1 <= date('w') && date('w') <= 5) {
            $data['event_data'] = Event::getEventByDays($request, $nextSaturday, $nextSunday);
        } elseif (date('w') === 6) {
            $data['event_data'] = Event::getEventByDays($request, $today, $tomorrow);
        } elseif (date('w') === 0) {
            $data['event_data'] = Event::getEventByDate($request, $today);
        }

        return view("welcome", $data);
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
