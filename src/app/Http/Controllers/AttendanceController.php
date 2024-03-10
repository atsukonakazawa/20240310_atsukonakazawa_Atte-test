<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Date;
use App\Models\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{

    public function start(Request $request)
    {

        $user_id=$request->only('user_id');
        $start=$request->all();
        Date::create($start)->with($user_id);

        /**
         * 打刻は1日一回までにしたい 
         * DB
         */
        $oldTimestamp = Date::where('user_id', $user_id)->latest()->first();
        if ($oldTimestamp) {
            $oldTimestampPunchIn = new Carbon($oldTimestamp->punchIn);
            $oldTimestampDay = $oldTimestampPunchIn->startOfDay();
        }
        $newTimestampDay = Carbon::today();

        /**
         * 日付を比較する。同日付の出勤打刻で、かつ直前のTimestampの退勤打刻がされていない場合エラーを吐き出す。
         */
        if (($oldTimestampDay == $newTimestampDay) && (empty($oldTimestamp->punchOut))){
            return redirect()->back()->with('error', 'すでに出勤打刻がされています');
        }




        /**以下、二重送信防止のための記述 */
        $request->session()->regenerateToken();

        return view('index');
    }

    public function finish(Request $request)
    {
        $user_id=$request->only('user_id');
        $finish=$request->all();
        Date::create($finish)->with($user_id);

        $timestamp = Date::where('user_id', $user_id)->latest()->first();

        if( !empty($timestamp->punchOut)) {
            return redirect()->back()->with('error', '既に退勤の打刻がされているか、出勤打刻されていません');
        }
        $timestamp->update([
            'punchOut' => Carbon::now()
        ]);


        /**以下、二重送信防止のための記述 */

        $request->session()->regenerateToken();

        return view('index');

    }

    public function break(Request $request)
    {
        $user_id=$request->only('user_id');
        $break=$request->all();
        Date::create($break)->with($user_id);

        $request->session()->regenerateToken();

        return view('index');

    }

    public function back(Request $request)
    {
        $user_id=$request->only('user_id');
        $back=$request->all();
        Date::create($back)->with($user_id);

        $request->session()->regenerateToken();

        return view('index');

    }


    public function list(Request $request)
    {
        $selected = $request->all();
        dd($selected);
        return view('attendance');

    }

}
