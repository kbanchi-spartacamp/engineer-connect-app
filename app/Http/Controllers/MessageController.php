<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Consts\MessageConst;
use App\Consts\UserConst;
use App\Consts\MentorConst;
use Illuminate\Support\Facades\DB;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Mentor $mentor)
    {
        $params = [
            'user_id' => $user->id,
            'mentor_id' => $mentor->id,
        ];
        $messages = Message::search($params)
            ->oldest()->get();

        $partner = '';
        $send_by = '';
        if (Auth::guard(UserConst::GUARD)->check()) {
            $partner = $mentor;
            $send_by = MessageConst::SEND_BY_USER;
        }
        if (Auth::guard(MentorConst::GUARD)->check()) {
            $partner = $user;
            $send_by = MessageConst::SEND_BY_MENTOR;
        }

        return view('messages.index', compact('jobOffer', 'messages', 'partner', 'send_by'));
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
    public function store(Request $request, Mentor $mentor, User $user)
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
            ->route('users.mentors.messages.index', [$user,$mentor])
            ->with('notice', 'Send Message');
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
