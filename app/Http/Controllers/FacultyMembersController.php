<?php

namespace App\Http\Controllers;

use App\facultyMembers;
use Illuminate\Http\Request;

use Illuminate\Http\JsonResponse;


use Validator;
use App;

class FacultyMembersController extends Controller
{

    public function getJobs(){
        $path = storage_path() . "/json/job.json";

        $data = json_decode(file_get_contents($path), true);

        $returnedData = [];

        foreach ($data as $element => $value) {
            array_push($returnedData,$value['name']);
        }
        return $returnedData;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = __('Heading.FacultyMembers');

        $members = facultyMembers::all();

        return view('Main.FacultyMember.facultyMemberlist',compact('title','members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = __('Heading.addNewMember');

        $data = $this->getJobs();

        return view('Main.FacultyMember.addNewMember',compact('title','data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jobs = $this->getJobs();

        $rules = [
            'userName' => 'required|between:5,50|regex:/^[\pL\s\-]+$/u',
            'job' => 'required|between:4,50|regex:/^[\pL\s\-]+$/u|in:'.implode(',',$jobs)
        ];
        // if application is in arabic lang
        $arabicMessage = [
            'userName.required' => '.من فضلك ادخل الاسم',
            'job.required' => '.من فضلك اختار الوظيفة',
            'userName.between' => '.الاسم يجب الا يقل عن 5 حروف',
            'job.between' => '.الوظيفة يجب الا تقل عن 4 حروف',
            'userName.regex' => '.الاسم يجب ان يتكون من حروف فقط',
            'job.regex' => '.الوظيفة يجب ان تكون حروف فقط',
            'job.in' => '.يجب ان تكون الوظيفة المختارة ضمن المعروضة فقط في القائمة'
        ];

        $engMessage = [
            'userName.regex' => 'The :attribute field should contain only characters.',
            'job.regex' => 'The :attribute field should contain only characters.',
        ];

        if (App::getLocale() == 'ar') {
            Validator::make($request->all(),$rules,$arabicMessage)->validate();
        }
        else{
            Validator::make($request->all(),$rules,$engMessage)->validate();
        }

        $member = new facultyMembers;

        $member->name = $request->userName;
        $member->job = $request->job;

        $member->save();

        return redirect('facultyMember/create')->with('sucess',__('message.Member Successfully Added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\facultyMembers  $facultyMembers
     * @return \Illuminate\Http\Response
     */
    public function show(facultyMembers $facultyMember)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\facultyMembers  $facultyMembers
     * @return \Illuminate\Http\Response
     */
    public function edit(facultyMembers $facultyMember)
    {
        $title = __('Heading.editMemberData');

        $data = $this->getJobs();

        return view('Main.FacultyMember.editMemberData',compact('title','data','facultyMember'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\facultyMembers  $facultyMembers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, facultyMembers $facultyMember)
    {
        $jobs = $this->getJobs();

        $rules = [
            'userName' => 'required|between:5,50|regex:/^[\pL\s\-]+$/u',
            'job' => 'required|between:4,50|regex:/^[\pL\s\-]+$/u|in:'.implode(',',$jobs)
        ];
        // if application is in arabic lang
        $arabicMessage = [
            'userName.required' => '.من فضلك ادخل الاسم',
            'job.required' => '.من فضلك اختار الوظيفة',
            'userName.between' => '.الاسم يجب الا يقل عن 5 حروف',
            'job.between' => '.الوظيفة يجب الا تقل عن 4 حروف',
            'userName.regex' => '.الاسم يجب ان يتكون من حروف فقط',
            'job.regex' => '.الوظيفة يجب ان تكون حروف فقط',
            'job.in' => '.يجب ان تكون الوظيفة المختارة ضمن المعروضة فقط في القائمة'
        ];

        $engMessage = [
            'userName.regex' => 'The :attribute field should contain only characters.',
            'job.regex' => 'The :attribute field should contain only characters.',
        ];

        if (App::getLocale() == 'ar') {
            Validator::make($request->all(),$rules,$arabicMessage)->validate();
        }
        else{
            Validator::make($request->all(),$rules,$engMessage)->validate();
        }
        // edit in DB Steps
        $facultyMember->name = $request->userName;
        $facultyMember->job = $request->job;
        $facultyMember->save(); // execute update

        return redirect('facultyMember/'.$facultyMember->id.'/edit')->with('sucess',__('message.Member Successfully Edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\facultyMembers  $facultyMembers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = [
            'id' => 'required|exists:faculty_members',
        ];
        // if application is in arabic lang
        $arabicMessage = [
            'id.required' => 'لا يوجد بيانات لعضو العضو في قاعدة البيانات',
            'id.exists' => 'لا يوجد بيانات لعضو العضو في قاعدة البيانات',
        ];

        $engMessage = [
            'id.required' => 'This memeber doesn\'t exist in the Database',
            'id.exists' => 'This memeber doesn\'t exist in the Database',
        ];

        if (App::getLocale() == 'ar') {
            $validator = Validator::make($request->all(),$rules,$arabicMessage);
        }
        else{
            $validator = Validator::make($request->all(),$rules,$engMessage);
        }


        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else{
            $member = facultyMembers::find($request->id);
            $member->delete();
            $msg = __('message.Member Successfully Deleted');
            return response()->json(array('msg' => $msg));
        }
    }

}
