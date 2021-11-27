<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\MentorSchedule;
use App\Consts\MentorConst;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Consts\UserConst;
use App\Models\Mentor;
use App\Consts\DayOfWeekConst;

class MentorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $skillCategoryId = $request->skill_category_id;
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $day = $request->day;
        $dayOfWeek = $request->day_of_week;
        $bookmark = $request->bookmark;
        $searchParam = [
            'skill_category_id'  => $skillCategoryId,
            'start_time'  => $startTime,
            'end_time'  => $endTime,
            'day'  => $day,
            'day_of_week'  => $dayOfWeek,
            'bookmark'  => $bookmark,
        ];

        // メンターおよびスケジュールの情報を取得
        $query = Mentor::query();
        // スキルカテゴリー条件
        if (!empty($skillCategoryId)) {
            $query->whereHas('mentor_skills', function ($q) use ($skillCategoryId) {
                $q->where('skill_category_id', $skillCategoryId);
            });
        }
        // 日付条件&開始終了時間条件
        if (!empty($day) && !empty($dayOfWeek)) {
            $day = new Carbon($day);
            $dayOfWeek = DayOfWeekConst::DAY_OF_WEEK_LIST_EN[$dayOfWeek];
            if (!empty($startTime) && !empty($endTime)) {
                $startTime = new Carbon($day->format('Y-m-d') . ' ' . $startTime);
                $endTime = new Carbon($day->format('Y-m-d') . ' ' . $endTime);
                $param = [
                    'startTime' => $startTime,
                    'endTime' => $endTime,
                    'day' => $day,
                    'dayOfWeek' => $dayOfWeek
                ];
                $query->whereHas('mentor_schedules', function ($q) use ($param) {
                    $q->where('day', $param['day'])
                        ->where('start_time', '>=', $param['startTime'])
                        ->where('start_time', '<=', $param['endTime']);
                    $q->orWhere('day_of_week', $param['dayOfWeek'])
                        ->where('start_time', '>=', $param['startTime'])
                        ->where('start_time', '<=', $param['endTime']);
                });
            } else {
                $param = [
                    'day' => $day,
                    'dayOfWeek' => $dayOfWeek
                ];
                $query->whereHas('mentor_schedules', function ($q) use ($param) {
                    $q->where('day', $param['day']);
                });
                $query->whereHas('mentor_schedules', function ($q) use ($param) {
                    $q->orWhere('day_of_week', $param['dayOfWeek']);
                });
            }
        }
        // ブックマーク
        if (!empty($bookmark) && ($bookmark == 'true')) {
            $param = [
                'user_id' => Auth::guard(UserConst::GUARD)->user()->id,
            ];
            $query->whereHas('bookmarks', function ($q) use ($param) {
                $q->where('user_id', $param['user_id']);
            });
        }
        // データの取得
        $mentors = $query->get();

        return $mentors;
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
                    $mentorSchedule->mentor_id = $request->mentor_id;
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
            }
        }
        if (!empty($day_of_week) && !empty($open_time) && !empty($end_time)) {
            $start_time = new Carbon($open_time);
            $end_time = new Carbon($end_time);
            DB::beginTransaction();
            try {
                while ($start_time < $end_time) {
                    $mentorSchedule = new MentorSchedule();
                    $mentorSchedule->mentor_id = $request->mentor_id;
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

        DB::beginTransaction();
        try {
            $mentorSchedule->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
