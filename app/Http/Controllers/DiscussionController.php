<?php

namespace App\Http\Controllers;

use App\discussion;
use Illuminate\Http\Request;

use App;
use Validator;

class DiscussionController extends Controller
{

    public function getJSONdata($file){
        $path = storage_path() . "/json/" .$file. ".json";

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
        $title = __('Heading.Discussionslist');

        $discussions = discussion::all();

        return view('Main.Discussion.Discussionlist',compact('title','discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = __('Heading.addNewDiscussions');
        $members = \App\facultyMembers::all();
        $Departments = $this->getJSONdata('Department');

        return view('Main.Discussion.addNewDiscussion',compact('title','members','Departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        for ($i=0; $i < count($request->supervisors) ; $i++) {
            for ($j=$i+1; $j < count($request->supervisors) ; $j++) {
                if ($request->supervisors[$i] === $request->supervisors[$j]) {
                    if (App::getLocale() == 'ar') {
                        return back()->withErrors('تأكد من اختيار مشرفين مختلفيين');
                    }
                    else{
                        return back()->withErrors('Please check of selecting different supervisor');
                    }
                }
            }
        }

        $Departments = $this->getJSONdata('Department');

        $rules = [
            'facultyMember' => 'required|exists:faculty_members,id',
            'discussionName' => 'required|string|between:5,200',
            'department' => 'required|in:'.implode(',',$Departments),
            'discussionDate' => 'required|date',
            'supervisors.*' => 'required|exists:faculty_members,id|different:facultyMember',
        ];

        //  if application is in arabic lang
        $arabicMessage = [
            'facultyMember.required' => 'من فضلك تأكد من اختيار عضو هيئة التدريس',
            'facultyMember.exists' => 'تأكد من اختيار عضو هيئة تدريس مخزن في قاعدة البيانات',

            'discussionName.required' => 'من فضلك تأكد من ادخال عنوان المناقشة',
            'discussionName.string' => 'من فضلك تأكد من ادخال قيمة نصية عنوان المناقشة ',
            'discussionName.between' => 'يجب ألا يقل عنوان المناقشة عن 5 حروف و ألا يزيد عن 200 حرف',

            'department.required' => 'من فضلك تأكد من اختيار القسم',
            'department.in' => 'من فضلك تأكد من اختيار القسم بشكل صحيح',

            'discussionDate.required' => 'من فضلك تأكد من ادخال تاريخ المناقشة ',
            'discussionDate.date' => 'من فضلك تأكد من ادخال تاريخ صحيح',

            'supervisors.0.required' => 'من فضلك تأكد من اختيار المشرف الأول',
            'supervisors.0.exists' => 'عفوًا ، المشرف الاول الذي اخترته غير مخزن في قاعدة البيانات',
            'supervisors.0.different' => 'خطأ :: تأكد من ان مقدم المناقشة و المشرف الاول شخصان مختلفان',

            'supervisors.1.required' => 'من فضلك تأكد من اختيار المشرف الثاني',
            'supervisors.1.exists' => 'عفوًا ، المشرف الثاني الذي اخترته غير مخزن في قاعدة البيانات',
            'supervisors.1.different' => 'خطأ :: تأكد من ان مقدم المناقشة و المشرف الثاني شخصان مختلفان',

            'supervisors.2.required' => 'من فضلك تأكد من اختيار المشرف الثالث',
            'supervisors.2.exists' => 'عفوًا ، المشرف الثالث الذي اخترته غير مخزن في قاعدة البيانات',
            'supervisors.2.different' => 'خطأ :: تأكد من ان مقدم المناقشة و المشرف الثالث شخصان مختلفان',
        ];


        $engMessage = [
            'supervisors.0.required' => 'Please check for selecting the first supervisor',
            'supervisors.0.exists' => 'Sorry, the First supervisor you have selected didn\'t exists in the database.',
            'supervisors.0.different' => 'Please check that first supervisor and Discussion Provider are different',

            'supervisors.1.required' => 'Please check for selecting the first supervisor',
            'supervisors.1.exists' => 'Sorry, the Second supervisor you have selected didn\'t exists in the database.',
            'supervisors.0.different' => 'Please check that first supervisor and Discussion Provider are different',

            'supervisors.2.required' => 'Please check for selecting the first supervisor',
            'supervisors.2.exists' => 'Sorry, the Third supervisor you have selected didn\'t exists in the database.',
            'supervisors.0.different' => 'Please check that first supervisor and Discussion Provider are different',
        ];

        if (App::getLocale() == 'ar') {
            Validator::make($request->all(),$rules,$arabicMessage)->validate();
        }
        else{
            Validator::make($request->all(),$rules,$engMessage)->validate();
        }

        $discussion = new discussion;

        $discussion->facultymemberId = $request->facultyMember;
        $discussion->discussionName = $request->discussionName;
        $discussion->department = $request->department;
        $discussion->discussionDate = $request->discussionDate;

        $result = $discussion->save();

        if($result){
            foreach ( $request->supervisors as $supervisorID) {
                $discussion->supervised()->attach($supervisorID);
            }
        }
        return redirect('discussion/create')->with('sucess',__('message.Discussion Successfully Added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function show(discussion $discussion)
    {
        $title = __('Heading.viewDiscussionData');
        return view('Main.Discussion.viewDiscussionData', compact('title','discussion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(discussion $discussion)
    {
        $title = __('Heading.editDiscussionsData');
        $members = \App\facultyMembers::all();
        $Departments = $this->getJSONdata('Department');

        return view('Main.Discussion.editDiscussionData',compact('title','members','Departments','discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, discussion $discussion)
    {

        for ($i=0; $i < count($request->supervisors) ; $i++) {
            for ($j=$i+1; $j < count($request->supervisors) ; $j++) {
                if ($request->supervisors[$i] === $request->supervisors[$j]) {
                    if (App::getLocale() == 'ar') {
                        return back()->withErrors('تأكد من اختيار مشرفين مختلفيين');
                    }
                    else{
                        return back()->withErrors('Please check of selecting different supervisor');
                    }
                }
            }
        }

        $Departments = $this->getJSONdata('Department');

        $rules = [
            'facultyMember' => 'required|exists:faculty_members,id',
            'discussionName' => 'required|string|between:5,200',
            'department' => 'required|in:'.implode(',',$Departments),
            'discussionDate' => 'required|date',
            'supervisors.*' => 'required|exists:faculty_members,id|different:facultyMember',
        ];

        //  if application is in arabic lang
        $arabicMessage = [
            'facultyMember.required' => 'من فضلك تأكد من اختيار عضو هيئة التدريس',
            'facultyMember.exists' => 'تأكد من اختيار عضو هيئة تدريس مخزن في قاعدة البيانات',

            'discussionName.required' => 'من فضلك تأكد من ادخال عنوان المناقشة',
            'discussionName.string' => 'من فضلك تأكد من ادخال قيمة نصية عنوان المناقشة ',
            'discussionName.between' => 'يجب ألا يقل عنوان المناقشة عن 5 حروف و ألا يزيد عن 200 حرف',

            'department.required' => 'من فضلك تأكد من اختيار القسم',
            'department.in' => 'من فضلك تأكد من اختيار القسم بشكل صحيح',

            'discussionDate.required' => 'من فضلك تأكد من ادخال تاريخ المناقشة ',
            'discussionDate.date' => 'من فضلك تأكد من ادخال تاريخ صحيح',

            'supervisors.0.required' => 'من فضلك تأكد من اختيار المشرف الأول',
            'supervisors.0.exists' => 'عفوًا ، المشرف الاول الذي اخترته غير مخزن في قاعدة البيانات',
            'supervisors.0.different' => 'خطأ :: تأكد من ان مقدم المناقشة و المشرف الاول شخصان مختلفان',

            'supervisors.1.required' => 'من فضلك تأكد من اختيار المشرف الثاني',
            'supervisors.1.exists' => 'عفوًا ، المشرف الثاني الذي اخترته غير مخزن في قاعدة البيانات',
            'supervisors.1.different' => 'خطأ :: تأكد من ان مقدم المناقشة و المشرف الثاني شخصان مختلفان',

            'supervisors.2.required' => 'من فضلك تأكد من اختيار المشرف الثالث',
            'supervisors.2.exists' => 'عفوًا ، المشرف الثالث الذي اخترته غير مخزن في قاعدة البيانات',
            'supervisors.2.different' => 'خطأ :: تأكد من ان مقدم المناقشة و المشرف الثالث شخصان مختلفان',
        ];

        $engMessage = [
            'supervisors.0.required' => 'Please check for selecting the first supervisor',
            'supervisors.0.exists' => 'Sorry, the First supervisor you have selected didn\'t exists in the database.',
            'supervisors.0.different' => 'Please check that first supervisor and Discussion Provider are different',

            'supervisors.1.required' => 'Please check for selecting the first supervisor',
            'supervisors.1.exists' => 'Sorry, the Second supervisor you have selected didn\'t exists in the database.',
            'supervisors.0.different' => 'Please check that first supervisor and Discussion Provider are different',

            'supervisors.2.required' => 'Please check for selecting the first supervisor',
            'supervisors.2.exists' => 'Sorry, the Third supervisor you have selected didn\'t exists in the database.',
            'supervisors.0.different' => 'Please check that first supervisor and Discussion Provider are different',
        ];

        if (App::getLocale() == 'ar') {
            Validator::make($request->all(),$rules,$arabicMessage)->validate();
        }
        else{
            Validator::make($request->all(),$rules,$engMessage)->validate();
        }

        $discussion->facultymemberId = $request->facultyMember;
        $discussion->discussionName = $request->discussionName;
        $discussion->department = $request->department;
        $discussion->discussionDate = $request->discussionDate;

        $result = $discussion->save();

        if($result){
            $discussion->supervised()->detach();
            foreach ( $request->supervisors as $supervisorID) {
                $discussion->supervised()->attach($supervisorID);
            }
        }
        return redirect('discussion/'.$discussion->id.'/edit')->with('sucess',__('message.Discussion Successfully Edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = [
            'id' => 'required|exists:discussions',
        ];
        // if application is in arabic lang
        $arabicMessage = [
            'id.required' => 'لا يوجد بيانات لتلك المناقشة في قاعدة البيانات',
            'id.exists' => 'لا يوجد بيانات لتلك المناقشة في قاعدة البيانات',
        ];

        $engMessage = [
            'id.required' => 'This vacation doesn\'t exist in the Database',
            'id.exists' => 'This vacation doesn\'t exist in the Database',
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
            $discussion = discussion::find($request->id);
            $discussion->delete();
            $msg = __('message.Discussion Successfully Deleted');
            return response()->json(array('msg' => $msg));
        }
    }
}
