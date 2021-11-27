<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Review;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $mentor_id)
    {
        $review = Review::where('user_id', $request->user_id)
            ->where('mentor_id', $mentor_id)
            ->first();

        if (empty($review)) {
            $review = new Review();
            $review->user_id = $request->user_id;
            $review->mentor_id = $mentor_id;
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

        return $review;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
