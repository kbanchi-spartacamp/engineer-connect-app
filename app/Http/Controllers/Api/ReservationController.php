<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Consts\UserConst;
use App\Consts\MentorConst;
use App\Models\Mentor;
use App\Models\MentorSkill;
use App\Models\MentorSchedule;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $messages = [
            'profile' => '',
            'skill_create' => '',
            'schedule_create' => ''
        ];

        $user_id = $request->user_id;
        $mentor_id = $request->mentor_id;
        $today = date("Y-m-d");

        $query = Reservation::query();
        if (!empty($user_id)) {
            $query->where('user_id', $user_id)
                ->where('day', '>=', $today);
            if (empty($query->id)) {
                $messages['reservation'] = '予定が入っていません。';
            }
        } else {
            $query->where('mentor_id', $mentor_id);
            $mentor = Mentor::find($mentor_id);
            if (empty($mentor->profile) || empty($mentor->profile_photo_path)) {
                $messages['profile'] = 'プロフィール(自己紹介・アイコン画像)を設定してください。';
            }
            $mentorSkill = MentorSkill::where('mentor_id', $mentor_id)->first();
            if (empty($mentorSkill)) {
                $messages['skill_create'] = '対応スキルが登録されていません。スキル登録してください。';
            }
            $mentorSchedule = MentorSchedule::where('mentor_id', $mentor_id)->first();
            if (empty($mentorSchedule)) {
                $messages['schedule_create'] = '対応スケジュールが登録されていません。スケジュール登録をしてください。';
            }

            $query->where('mentor_id', $mentor_id)
                ->where('day', '>=', $today);
        }

        $reservations = $query->with(['user', 'mentor'])->get();

        return $reservations;
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
        $reservation->user_id = $request->user_id;
        $reservation->mentor_id = $request->mentor_id;
        $reservation->day = $request->day;
        $reservation->start_time = $request->start_time;

        DB::beginTransaction();
        try {
            $reservation->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        // $mentor = Mentor::find($reservation->mentor_id);
        // $reservation = Reservation::find($reservation->id)->with(['user', "mentor"])->first();
        // Mail::to($mentor)->send(new SendMail(MailConst::RESERVATION, $reservation));

        return $reservation;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $reservation = Reservation::find($id);
        return $reservation;
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
        //
    }
}
