<?php

namespace App\Http\Controllers;

use App\Consts\DayOfWeekConst;
use App\Models\MentorSchedule;
use App\Models\SkillCategory;
use App\Models\Mentor;
use Illuminate\Support\Facades\Auth;
use App\Consts\UserConst;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mentors = Mentor::all();
        $skillCategories = SkillCategory::all();
        return view('mentors.index', compact('mentors', 'skillCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Mentor $mentor)
    {
        $dates = [];
        $date = now();
        for ($i = 0; $i < 7; $i++) {
            $dates[] = $date->formatLocalized('%m/%d(%a)');
            $date = $date->addDay();
        }

        $skillCategories = SkillCategory::all();

        $date = now();
        $start_time = $date->addMinutes(30 - $date->minute % 30);
        $end_time = new Carbon('24:00:00');
        $times = [];
        while ($start_time < $end_time) {
            $times[] = $start_time->format('H:i');
            $start_time = $start_time->addMinute(30);
        }

        // 検索条件を設定
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
        if (!empty($startTime) && !empty($endTime)) {
            $startTime = new Carbon($startTime);
            $endTime = new Carbon($endTime);
            if (!empty($day) && !empty($dayOfWeek)) {
                $day = new Carbon($day);
                $dayOfWeek = DayOfWeekConst::DAY_OF_WEEK_LIST_EN[$dayOfWeek];
            }
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
            });
            $query->whereHas('mentor_schedules', function ($q) use ($param) {
                $q->orWhere('day_of_week', $param['dayOfWeek'])
                    ->where('start_time', '>=', $param['startTime'])
                    ->where('start_time', '<=', $param['endTime']);
            });
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

        //テーブルの時間取得

        //1440をfor文で回す
        $schedules = [];
        $schedule = strtotime('00:00');
        for ($i = 0; $i < 1440; $i += 30) {
            $schedules[] = $schedule;
        }

        return view('mentors.show', compact('mentor', 'dates', 'skillCategories', 'times', 'searchParam', 'schedules'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\Response
     */
    public function edit(Mentor $mentor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mentor $mentor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mentor  $mentor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mentor $mentor)
    {
        //
    }

    public function dashboard(Request $request)
    {
        return view('auth.mentor.dashboard');
    }
}
