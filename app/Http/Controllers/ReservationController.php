<?php

namespace App\Http\Controllers;

use App\Consts\MentorConst;
use App\Models\Mentor;
use App\Models\SkillCategory;
use App\Models\MentorSchedule;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Consts\UserConst;
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
        $today = date("Y-m-d");
        $query = Reservation::query();
        if (Auth::guard(UserConst::GUARD)->check()) {
            $query->where('user_id', Auth::guard(UserConst::GUARD)->user()->id)
                ->where('day','>=' ,$today);
        } else {
            $query->where('mentor_id', Auth::guard(MentorConst::GUARD)->user()->id)
                ->where('day','>=', $today);
        }
        $reservations = $query->get();

        return view('reservations.index', compact('reservations'));
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
