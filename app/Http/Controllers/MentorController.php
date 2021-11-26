<?php

namespace App\Http\Controllers;

use App\Consts\DayOfWeekConst;
use App\Models\MentorSkill;
use App\Models\SkillCategory;
use App\Models\Mentor;
use Illuminate\Support\Facades\Auth;
use App\Consts\MentorConst;
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

        $mentor_skills = Mentorskill::all();
        $query = Mentor::query();
        $query->where('id', '<>', Auth::guard(MentorConst::GUARD)->user()->id);
        $mentors = $query->get();


        return view('mentors.index', compact('mentors', 'mentor_skills'));
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
        // 本日の日付を取得
        $today = Carbon::today();
        
        //2日目の日付を取得
        $tommorrow = new Carbon('+1 day');
        
        // 3日目の日付を取得
        $dayAfterTommorrow = new Carbon('+2 day');
        
        // // 4日目の日付を取得
        $threeDaysLater = new Carbon('+3 day');
        
        // // 5日目の日付を取得
        $fourDaysLater = new Carbon('+4 day');
        
        // // 6日目の日付を取得
        $fiveDaysLater = new Carbon('+5 day');

        // //7日目の日付を取得
        $sixDaysLater = new Carbon('+6 day');
        

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

        return view('mentors.show', compact('mentor', 'today', 'tommorrow','dayAfterTommorrow','threeDaysLater', 'fourDaysLater', 'fiveDaysLater', 'sixDaysLater', 'skillCategories', 'times', 'searchParam'));
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
