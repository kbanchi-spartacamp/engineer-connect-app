<?php

namespace App\Http\Controllers;

use App\Consts\DayOfWeekConst;
use App\Models\Mentor;
use App\Models\MentorSchedule;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Consts\MentorConst;
use App\Consts\UserConst;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MentorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 本日から一週間分の日付を取得
        $dates = [];
        $date = now();
        for ($i = 0; $i < 7; $i++) {
            $dates[] = $date->copy();
            $date = $date->addDay();
        }

        // スキルカテゴリーの一覧を取得
        $skillCategories = SkillCategory::all();

        // ブックマーク情報を取得


        // 時間帯のプルダウンを取得
        $date = now();
        if ($request->day == $date->format('Y-m-d')) {
            $start_time = $date->addMinutes(30 - $date->minute % 30);
        } else {
            $start_time = new Carbon('00:00:00');
        }
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
        // 画面遷移
        return view('mentor_schedules.index', compact('dates', 'skillCategories', 'times', 'mentors', 'searchParam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = MentorSchedule::query();
        $query->where('mentor_id', Auth::guard(MentorConst::GUARD)->user()->id)
            ->where('regular_type', '0')
            ->where('day_of_week', '<>', null);
        $regular_mentorSchedules = $query->get();

        $query = MentorSchedule::query();
        $query->where('mentor_id', Auth::guard(MentorConst::GUARD)->user()->id)
            ->where('regular_type', '1')
            ->where('day', '>=', date("Y-m-d"));
        $irregular_mentorSchedules = $query->get();

        $date = now();
        $start_time = $date->addMinutes(30 - $date->minute % 30);
        $end_time = new Carbon('24:00:00');
        $times = [];
        while ($start_time < $end_time) {
            $times[] = $start_time->format('H:i');
            $start_time = $start_time->addMinute(30);
        }

        $start = new Carbon('00:00:00');
        $generally_time = $start->addMinutes($start->minute % 30);
        $open_times = [];
        while ($generally_time < $end_time) {
            $open_times[] = $generally_time->format('H:i');
            $generally_time = $generally_time->addMinute(30);
        }

        $mentorIrregularSchedules = MentorSchedule::where('mentor_id', Auth::guard(MentorConst::GUARD)->user()->id)
            ->where('regular_type', 1)
            ->whereDate('day', now())
            ->get();

        $mentorRegularSchedules = MentorSchedule::where('mentor_id', Auth::guard(MentorConst::GUARD)->user()->id)
            ->where('regular_type', 0)
            ->get();

        return view('mentor_schedules.create', compact('times', 'open_times', 'mentorIrregularSchedules', 'mentorRegularSchedules', 'regular_mentorSchedules', 'irregular_mentorSchedules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        return redirect()->route('mentor_schedules.create')->with('notice', '新しいスケジュールを登録しました');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MentorSchedule  $mentorSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(MentorSchedule $mentorSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MentorSchedule  $mentorSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(MentorSchedule $mentorSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MentorSchedule  $mentorSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MentorSchedule $mentorSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MentorSchedule  $mentorSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(MentorSchedule $mentorSchedule)
    {
        DB::beginTransaction();
        try {
            $mentorSchedule->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors('エラーが発生しました');
        }

        return redirect()
            ->route('mentor_schedules.create', $mentorSchedule)
            ->with('notice', 'スケジュールを削除しました');
    }
}
