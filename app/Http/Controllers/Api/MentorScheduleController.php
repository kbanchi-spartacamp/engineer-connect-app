<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\MentorSchedule;
use App\Consts\MentorConst;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MentorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mentorSchedules = MentorSchedule::all();
        return $mentorSchedules;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mentorSchedule = new MentorSchedule();
        $today_start_time = $request->today_start_time;
        $today_end_time = $request->today_end_time;
        $day_of_week = $request->day_of_week;
        $open_time = $request->open_time;
        $end_time = $request->end_time;

        if (!empty($today_start_time) && !empty($today_end_time)) {
            $start_time = new Carbon($today_start_time);
            $end_time = new Carbon($today_end_time);
            DB::beginTransaction();
            try {
                while ($start_time < $end_time) {
                    $mentorSchedule = new MentorSchedule();
                    $mentorSchedule->mentor_id = Auth::guard(MentorConst::GUARD)->user()->id;
                    $mentorSchedule->day = now();
                    $mentorSchedule->day_of_week = null;
                    $mentorSchedule->start_time = $start_time;
                    $mentorSchedule->regular_type = 1;

                    $mentorSchedule->save();

                    $start_time = $start_time->addMinute(30);
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withInput()
                    ->withErrors('登録でエラーが発生しました');
            }
        }
        if (!empty($day_of_week) && !empty($open_time) && !empty($end_time)) {
            $start_time = new Carbon($open_time);
            $end_time = new Carbon($end_time);
            DB::beginTransaction();
            try {
                while ($start_time < $end_time) {
                    $mentorSchedule = new MentorSchedule();
                    $mentorSchedule->mentor_id = Auth::guard(MentorConst::GUARD)->user()->id;
                    $mentorSchedule->day = null;
                    $mentorSchedule->day_of_week = $day_of_week;
                    $mentorSchedule->start_time = $start_time;
                    $mentorSchedule->regular_type = 0;

                    $mentorSchedule->save();

                    $start_time = $start_time->addMinute(30);
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->withInput()
                    ->withErrors('登録でエラーが発生しました');
            }
        }

        return $mentorSchedule;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mentorSchedule = MentorSchedule::find($id);
        $mentorSchedule->delete();

        return $mentorSchedule;
    }
}
