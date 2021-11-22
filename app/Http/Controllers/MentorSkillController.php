<?php

namespace App\Http\Controllers;

use App\Models\MentorSkill;
use App\Models\SkillCategory;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Consts\MentorConst;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = MentorSkill::query();
        $query->where('mentor_id', Auth::guard(MentorConst::GUARD)->user()->id);
        $mentor_skills =  $query->get();

        $mentorSkill_ids = Auth::guard(MentorConst::GUARD)->user()->mentor_skills->pluck("skill_category_id");
        $unregistered_skill_categories = SkillCategory::whereNotIn('id', $mentorSkill_ids)->get();
        $mentorSkill = new MentorSkill();
        return view('mentors.mentor_skills.create', compact('mentorSkill', 'unregistered_skill_categories', 'mentor_skills'));
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

        DB::beginTransaction();
        try {
            $mentorSkill->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors('エラーが発生しました');
        }

        return redirect()
            ->route('mentors.mentor_skills.create', Auth::guard(MentorConst::GUARD)->user())
            ->with('notice', 'スキルを登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MentorSkill  $mentorSkill
     * @return \Illuminate\Http\Response
     */
    public function show(MentorSkill $mentorSkill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MentorSkill  $mentorSkill
     * @return \Illuminate\Http\Response
     */
    public function edit(MentorSkill $mentorSkill)
    {
        return view('mentors.mentor_skills.edit', compact('mentorSkill'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MentorSkill  $mentorSkill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MentorSkill $mentorSkill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MentorSkill  $mentorSkill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mentor $mentor, MentorSkill $mentorSkill)
    {

        DB::beginTransaction();
        try {
            $mentorSkill->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->withErrors('エラーが発生しました');
        }

        return redirect()
            ->route('mentors.mentor_skills.create', $mentor)
            ->with('notice', 'スキルを削除しました');
    }
}
