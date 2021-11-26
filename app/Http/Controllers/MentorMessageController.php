<?php

namespace App\Http\Controllers;

use App\Models\MentorMessage;
use App\Models\Mentor;
use Illuminate\Http\Request;
use App\Consts\MentorConst;
use App\Consts\MessageConst;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MentorMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Mentor $mentor)
    {
        $params = [
            'send_mentor_id' => Auth::guard(MentorConst::GUARD)->user()->id,
            'recieve_mentor_id' => $mentor->id,
        ];

        $query = MentorMessage::query();
        $query->where(function ($query) use ($params) {
            $query->where('send_mentor_id', $params['send_mentor_id'])
                ->where('recieve_mentor_id', $params['recieve_mentor_id']);
        });
        $query->orWhere(function ($query) use ($params) {
            $query->where('send_mentor_id', $params['recieve_mentor_id'])
                ->where('recieve_mentor_id', $params['send_mentor_id']);
        });
        $messages = $query->oldest()->get();

        $messengers = [Auth::guard(MentorConst::GUARD)->user(), $mentor];

        return view('mentor_messages.index', compact('mentor', 'messages', 'messengers'));
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
    public function store(Request $request, Mentor $mentor)
    {
        $message = new MentorMessage();
        $message->message = $request->message;
        $message->send_mentor_id = Auth::guard(MentorConst::GUARD)->user()->id;
        $message->recieve_mentor_id = $mentor->id;

        DB::beginTransaction();
        try {
            $message->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                ->withErrors('エラーが発生しました');
        }

        $request->session()->regenerateToken();

        return redirect()
            ->route('mentors.messages.index', [$mentor])
            ->with('notice', 'Send Message');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MentorMessage  $mentorMessage
     * @return \Illuminate\Http\Response
     */
    public function show(MentorMessage $mentorMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MentorMessage  $mentorMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(MentorMessage $mentorMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MentorMessage  $mentorMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MentorMessage $mentorMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MentorMessage  $mentorMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(MentorMessage $mentorMessage)
    {
        //
    }
}
