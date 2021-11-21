<?php

namespace App\Http\Controllers;

use App\Consts\MentorConst;
use App\Models\Mentor;
use App\Models\SkillCategory;
use App\Models\MentorSchedule;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Consts\UserConst;
use App\Models\MentorSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $messages = [
            'profile' => '',
            'skill_create' => '',
            'schedule_create' => '',
        ];

        $query = Reservation::query();
        if (Auth::guard(UserConst::GUARD)->check()) {
            $query->where('user_id', Auth::guard(UserConst::GUARD)->user()->id);
        } else {
            $query->where('mentor_id', Auth::guard(MentorConst::GUARD)->user()->id);
            $mentor = Mentor::find(Auth::guard(MentorConst::GUARD)->user()->id);
            if (empty($mentor->profile) || empty($mentor->profile_photo_path)) {
                $messages['profile'] = 'プロフィール(自己紹介・アイコン画像)を設定してください。';
            }
            $mentorSkill = MentorSkill::where('mentor_id', Auth::guard(MentorConst::GUARD)->user()->id)->first();
            if (empty($mentorSkill)) {
                $messages['skill_create'] = '対応スキルが登録されていません。スキル登録してください。';
            }
            $mentorSchedule = MentorSchedule::where('mentor_id', Auth::guard(MentorConst::GUARD)->user()->id)->first();
            if (empty($mentorSchedule)) {
                $messages['schedule_create'] = '対応スケジュールが登録されていません。スケジュール登録をしてください。';
            }
        }
        $reservations = $query->get();

        return view('reservations.index', compact('reservations'))
            ->with($messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $mentorScheduleId = $request->mentor_schedule_id;
        $day = $request->day;
        $mentorSchedule = MentorSchedule::find($mentorScheduleId);
        return view('reservations.create', compact('mentorSchedule', 'day'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reservation = new Reservation();
        $reservation->user_id = Auth::guard(UserConst::GUARD)->user()->id;
        $reservation->mentor_id = $request->mentor_id;
        $reservation->day = $request->day;
        $reservation->start_time = $request->start_time;
        $reservation->save();

        return redirect()
            ->route('reservations.show', $reservation);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(MentorSchedule $mentorSchedule, Reservation $reservation, Mentor $mentor)
    {
        $mentorSchedule->mentor_id = $reservation->mentor_id;
        $mentorScheduleId = $reservation->mentor_schedule_id;
        $day = $reservation->day;
        $mentorSchedule = MentorSchedule::find($mentorScheduleId);
        return view('reservations.show', compact('reservation', 'day', 'mentorSchedule', 'mentor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
