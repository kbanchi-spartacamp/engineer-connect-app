<?php

namespace App\Http\Controllers\Api;

use App\Models\MentorSkill;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mentor;
use App\Consts\MentorConst;

class MentorSkillController extends Controller
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
    public function store(Request $request)
    {
        $mentorSkill = new MentorSkill();
        $mentorSkill->mentor_id = Auth::guard(MentorConst::GUARD)->user()->id;
        $mentorSkill->skill_category_id = $request->skill_category_id;
        $mentorSkill->experience_year = $request->experience_year;
        $mentorSkill->save();

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
        $mentorSkill->delete();
        return $mentorSkill;
    }
}
