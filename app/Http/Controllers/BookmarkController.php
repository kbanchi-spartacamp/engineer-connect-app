<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mentor;
use App\Consts\UserConst;
use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $bookmark = new Bookmark();
        $bookmark->user_id = Auth::guard(UserConst::GUARD)->user()->id;
        $bookmark->mentor_id = $mentor->id;

        DB::beginTransaction();
        try {
            $bookmark->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors('エラーが発生しました');
        }

        return redirect()->route('mentors.show', $mentor)
            ->with('notice', 'ブックマークしました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function show(Bookmark $bookmark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookmark $bookmark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookmark $bookmark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bookmark  $bookmark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mentor $mentor, Bookmark $bookmark)
    {
        DB::beginTransaction();
        try {
            $bookmark->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors('エラーが発生しました');
        }

        return redirect()->route('mentors.show', $mentor)
            ->with('notice', 'ブックマークを取り消しました');
    }
}
