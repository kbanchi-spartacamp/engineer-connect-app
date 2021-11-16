<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\MentorSchedule;
use App\Models\SkillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Consts\MentorConst;

class MentorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mentor_schedules.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mentorSchedule = new MentorSchedule();
        return view('mentor_schedules.create', compact('mentorSchedule'));
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
        $mentorSchedule->mentor_id = Auth::guard(MentorConst::GUARD)->user()->id;
        $mentorSchedule->day = $request->day;
        $mentorSchedule->day_of_week = $request->day_of_week;
        $mentorSchedule->start_time = $request->start_time;
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
