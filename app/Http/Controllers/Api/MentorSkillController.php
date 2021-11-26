<?php

namespace App\Http\Controllers\Api;

use App\Models\MentorSkill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mentor;
use App\Consts\MentorConst;
use Illuminate\Support\Facades\DB;

class MentorSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $mentor_skills = MentorSkill::with('skill_category')->where('mentor_id', $id)->get();
        return $mentor_skills;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mentorSkill = new MentorSkill();
        $mentorSkill->mentor_id = $request->mentor_id;
        $mentorSkill->skill_category_id = $request->skill_category_id;
        $mentorSkill->experience_year = $request->experience_year;

        DB::beginTransaction();
        try {
            $mentorSkill->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return $mentorSkill;
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
        $mentorSkill = MentorSkill::find($id);
        DB::beginTransaction();
        try {
            $mentorSkill->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors('エラーが発生しました');
        }

        return $mentorSkill;
    }
}
