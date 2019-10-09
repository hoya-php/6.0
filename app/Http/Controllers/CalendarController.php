<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Holiday;
use App\Calendar;
use App\Shifts;
use App\Members;

class CalendarController extends Controller
{
    public function getHoliday(Request $request)
    {
        // 休日データ取得
        $data = new Holiday();
        $list = Holiday::all();
        return view('calendar.holiday', ['list' => $list,'data' => $data]);
    }
    public function getHolidayId($id)
    {
        // 休日データ取得
        $data = new Holiday();
        if (isset($id)) {
            $data = Holiday::where('id', '=', $id)->first();
        }
        $list = Holiday::select('id','day','description','created_at','updated_at') -> get();

        return view('calendar.holiday', ['list' => $list, 'data' => $data]);
    }

    public function postHoliday(Request $request)
    {
        $validatedData = $request->validate([
            'day' => 'required|date_format:Y-m-d',
            'description' => 'required',
        ]);

        // POSTで受信した休日データの登録
        if (isset($request->id)) {
            $holiday = Holiday::where('id', '=', $request->id)->first();
            $holiday->day = $request->day;
            $holiday->description = $request->description;
            $holiday->save();
        } else {
            $holiday = new Holiday();
            $holiday->day = $request->day;
            $holiday->description = $request->description;
            $holiday->save();
        }
        // 休日データ取得
        $data = new Holiday();

        $list = Holiday::select('id','day','description','created_at','updated_at') -> get();

        return view('calendar.holiday', ['list' => $list, 'data' => $data]);
    }

    public function deleteHoliday(Request $request)
    {
        // DELETEで受信した休日データの削除
        if (isset($request->id)) {
            $holiday = Holiday::where('id', '=', $request->id)->first();
            $holiday->delete();
        }
        // 休日データ取得
        $data = new Holiday();

        $list = Holiday::all();

        return view('calendar.holiday', ['list' => $list, 'data' => $data]);
    }

    public function index(Request $request)
    {
        $Hol_list = Holiday::select('day') -> get();
        //\Debugbar::info($list);
        $cal = new Calendar();

        //calendarクラスよりカレンダーのタグを受け取る
        $tag = $cal->showCalendarTag($request->month, $request->year, $Hol_list);

        return view('calendar.index', ['cal_tag' => $tag]);
    }

}
