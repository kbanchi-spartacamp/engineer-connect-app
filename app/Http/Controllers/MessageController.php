<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\Message;
use App\Consts\UserConst;
use App\Consts\MentorConst;
use App\Consts\MessageConst;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Mentor $mentor, User $user)
    {
        $params = [
            'mentor_id' => $mentor->id,
            'user_id' => $user->id,
        ];
        $messages = Message::search($params)
            ->oldest()->get();

        $partner = '';
        $send_by = '';
        if (Auth::guard(UserConst::GUARD)->check()) {
            $partner = $mentor->company;
            $send_by = MessageConst::SEND_BY_USER;
        }
        if (Auth::guard(MentorConst::GUARD)->check()) {
            $partner = $user;
            $send_by = MessageConst::SEND_BY_MENTOR;
        }

        return view('messages.index', compact('mentor', 'messages', 'partner', 'send_by'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Mentor $mentor, User $user)
    {
        $message = new Message();
        $message->message = $request->message;
        $message->mentor_id = $mentor->id;
        $message->user_id = $user->id;
        if (Auth::guard(UserConst::GUARD)->check()) {
            $message->send_by = MessageConst::SEND_BY_USER;
        }
        if (Auth::guard(MentorConst::GUARD)->check()) {
            $message->send_by = MessageConst::SEND_BY_MENTOR;
        }

        DB::beginTransaction();
        try {
            $message->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()
                ->withErrors('エラーが発生しました');
        }

        return redirect()
            ->route('mentors.users.messages.index', [$mentor, $user])
            ->with('notice', 'Send Message');
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
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
