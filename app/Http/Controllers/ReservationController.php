<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\SkillCategory;
use App\Models\MentorSchedule;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Consts\MentorConst;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MentorSchedule $mentorSchedule)
    {
        $reservations = Reservation::all();
        return view('reservations.index',compact('reservations'));
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
        $reservation->mentor_id = Auth::guard(MentorConst::GUARD)->user()->id;
        $reservation->skill_category_id = $request->skill_category_id;
        $reservation->experience_year = $request->experience_year;
        $reservation->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(MentorSchedule $mentorSchedule, Reservation $reservation)
    {
        return view('reservations.show');
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
