<?php

namespace App\Http\Controllers;

use App\Models\MentorSkill;
use Illuminate\Http\Request;

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
        return view('mentors.mentor_skills.create');
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
        //
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
    public function destroy(MentorSkill $mentorSkill)
    {
        //
    }
}
