<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\MentorSchedule;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Consts\MentorConst;
use Illuminate\Support\Carbon;

class MentorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        $query = Mentor::query();
        $skillCategoryId = $request->skill_category_id;
        if (!empty($skillCategoryId)) {
            $query->whereHas('mentor_skills', function ($q) use ($skillCategoryId) {
                $q->where('skill_category_id', $skillCategoryId);
            });
        }
        $mentors = $query->get();
        // dd($mentors);

        return view('mentor_schedules.index', compact('dates', 'skillCategories', 'times', 'mentors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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

        $mentorSchedule = new MentorSchedule();
        $mentorSchedules = MentorSchedule::all();
        return view('mentor_schedules.create', compact('mentorSchedule','times','open_times', 'mentorSchedules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {{ dd($request->start_time); }}
        while ($request->start_time < $request->end_time) {
            $time = // $request->start_timeに30分ずつ足していきたい。
        }



        $mentorSchedule = new MentorSchedule();
        $mentorSchedule->mentor_id = Auth::guard(MentorConst::GUARD)->user()->id;
        $mentorSchedule->day =$request->day;
        $mentorSchedule->day_of_week = $request->day_of_week;
        $mentorSchedule->start_time = $time;
        $mentorSchedule->regular_type = $request->regular_type;
        $mentorSchedule->save();
        return redirect()->route('mentor_schedules.create', Auth::guard(MentorConst::GUARD)->user());
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
    public function destroy(Mentor $mentor, MentorSchedule $mentorSchedule)
    {
        $mentorSchedule->delete();
        return redirect()->route('mentor_schedules.create', $mentor);
    }
}
