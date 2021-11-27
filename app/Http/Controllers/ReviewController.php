<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Consts\UserConst;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
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

        $review = Review::where('user_id', Auth::guard(UserConst::GUARD)->user()->id)
            ->where('mentor_id', $mentor->id)
            ->first();

        if (empty($review)) {
            $review = new Review();
            $review->user_id = Auth::guard(UserConst::GUARD)->user()->id;
            $review->mentor_id = $mentor->id;
            $review->star = $request->review;
        } else {
            $review->star = $request->review;
        }

        DB::beginTransaction();
        try {
            $review->save();
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            return back()->withInput()
                ->withErrors('エラーが発生しました');
        }

        return redirect()->route('mentors.show', $mentor)
            ->with('notice', 'レビューしました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
