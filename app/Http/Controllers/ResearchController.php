<?php

namespace App\Http\Controllers;

use App\research;
use Illuminate\Http\Request;

use App;
use Validator;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = __('Heading.Researchlist');

        $researches = research::all();

        return view('Main.Research.ResearchList',compact('title','researches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = __('Heading.addNewResearch');
        $members = \App\facultyMembers::all();

        return view('Main.Research.addNewResearch',compact('title','members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'facultyMember' => 'required|exists:faculty_members,id',
            'researchName' => 'required|string|between:5,200',
            'magazine' => 'required|string|between:5,100',
            'publishDate' => 'required|date',
            'publishPlace' => 'required|string|between:5,100',
            'effectCoefficient' => 'required|regex:/^\d{0,2}(\.\d{0,3})?$/',
            'bonusValue' => 'required|regex:/^\d{0,4}(\.\d{0,2})?$/',
            'participantsBonusValue' => 'required|integer|min:0'
        ];
        //  if application is in arabic lang
        $arabicMessage = [
            'facultyMember.required' => 'من فضلك تأكد من اختيار عضو هيئة التدريس',
            'facultyMember.exists' => 'تأكد من اختيار عضو هيئة تدريس مخزن في قاعدة البيانات',

            'researchName.required' => 'من فضلك تأكد من ادخال اسم البحث',
            'researchName.string' => 'من فضلك تأكد من ادخال قيمة نصية لاسم البحث',
            'researchName.between' => 'يجب ألا يقل اسم البحث عن 5 حروف و ألا يزيد عن 200 حرف',

            'magazine.required' => 'من فضلك تأكد من ادخال اسم المجلة',
            'magazine.string' => 'من فضلك تأكد من ادخال اسم المجلة صحيحا',
            'magazine.between' => 'يجب ألا يقل اسم المجلة عن 5 حروف و ألا يزيد عن 100 حرف',

            'publishDate.required' => 'من فضلك تأكد من ادخال تاريخ النشر ',
            'publishDate.date' => 'من فضلك تأكد من ادخال تاريخ صحيح',

            'publishPlace.required' => 'من فضلك تأكد من ادخال مكان النشر',
            'publishPlace.string' => 'من فضلك تأكد من ادخال مكان النشر صحيحا',
            'publishPlace.between' => 'يجب ألا يقل مكان النشر عن 5 حروف و ألا يزيد عن 100 حرف',

            'effectCoefficient.required' => 'من فضلك تأكد من ادخال معامل التأثير',
            'effectCoefficient.regex' =>
                'معامل التأثير يجيب الا يزيد عن عددين قبل العلامة العشرية و  3 ارقام عشرية ',

            'bonusValue.required' => 'من فضلك تأكد من ادخال قيمة المكافأة',
            'bonusValue.regex' =>
            'قيمة المكافأة يجيب الا يزيد عن 4 ارقام قبل العلامة العشرية و رقمين عشريين ',

            'participantsBonusValue.required' => 'يجب ألا يقل رقم قيمة المشاركين في البحث عن رقم 1',
            'participantsBonusValue.integer' =>
                    'من فضلك تأكد من ادخال رقم صحيح لقيمة المشاركين في البحث',
            'participantsBonusValue.min' => 'يجب ألا يقل قيمة المشاركين في البحث عن رقم 0',
        ];

        if (App::getLocale() == 'ar') {
            Validator::make($request->all(),$rules,$arabicMessage)->validate();
        }
        else{
            Validator::make($request->all(),$rules)->validate();
        }

        $research = new research;

        $research->facultymemberId = $request->facultyMember;
        $research->researchName = $request->researchName;
        $research->magazine = $request->magazine;
        $research->publishDate = $request->publishDate;
        $research->publishPlace = $request->publishPlace;
        $research->effectCoefficient = $request->effectCoefficient;
        $research->bonusValue = $request->bonusValue;
        $research->participantsBonusValue = $request->participantsBonusValue;

        $research->save();

        return redirect('research/create')->with('sucess',__('message.Research Successfully Added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\research  $research
     * @return \Illuminate\Http\Response
     */
    public function show(research $research)
    {
        $title = __('Heading.viewResearchData');
        return view('Main.Research.viewResearchData', compact('title','research'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\research  $research
     * @return \Illuminate\Http\Response
     */
    public function edit(research $research)
    {
        $title = __('Heading.editResearchData');
        $members = \App\facultyMembers::all();

        return view('Main.Research.editResearchData',compact('title','members','research'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\research  $research
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, research $research)
    {
        $rules = [
            'facultyMember' => 'required|exists:faculty_members,id',
            'researchName' => 'required|string|between:5,200',
            'magazine' => 'required|string|between:5,100',
            'publishDate' => 'required|date',
            'publishPlace' => 'required|string|between:5,100',
            'effectCoefficient' => 'required|regex:/^\d{0,2}(\.\d{0,3})?$/',
            'bonusValue' => 'required|regex:/^\d{0,4}(\.\d{0,2})?$/',
            'participantsBonusValue' => 'required|integer|min:0'
        ];
        //  if application is in arabic lang
        $arabicMessage = [
            'facultyMember.required' => 'من فضلك تأكد من اختيار عضو هيئة التدريس',
            'facultyMember.exists' => 'تأكد من اختيار عضو هيئة تدريس مخزن في قاعدة البيانات',

            'researchName.required' => 'من فضلك تأكد من ادخال اسم البحث',
            'researchName.string' => 'من فضلك تأكد من ادخال قيمة نصية لاسم البحث',
            'researchName.between' => 'يجب ألا يقل اسم البحث عن 5 حروف و ألا يزيد عن 200 حرف',

            'magazine.required' => 'من فضلك تأكد من ادخال اسم المجلة',
            'magazine.string' => 'من فضلك تأكد من ادخال اسم المجلة صحيحا',
            'magazine.between' => 'يجب ألا يقل اسم المجلة عن 5 حروف و ألا يزيد عن 100 حرف',

            'publishDate.required' => 'من فضلك تأكد من ادخال تاريخ النشر ',
            'publishDate.date' => 'من فضلك تأكد من ادخال تاريخ صحيح',

            'publishPlace.required' => 'من فضلك تأكد من ادخال مكان النشر',
            'publishPlace.string' => 'من فضلك تأكد من ادخال مكان النشر صحيحا',
            'publishPlace.between' => 'يجب ألا يقل مكان النشر عن 5 حروف و ألا يزيد عن 100 حرف',

            'effectCoefficient.required' => 'من فضلك تأكد من ادخال معامل التأثير',
            'effectCoefficient.regex' =>
                'معامل التأثير يجيب الا يزيد عن عددين قبل العلامة العشرية و  3 ارقام عشرية ',

            'bonusValue.required' => 'من فضلك تأكد من ادخال قيمة المكافأة',
            'bonusValue.regex' =>
            'قيمة المكافأة يجيب الا يزيد عن 4 ارقام قبل العلامة العشرية و رقمين عشريين ',

            'participantsBonusValue.required' => 'يجب ألا يقل رقم قيمة المشاركين في البحث عن رقم 1',
            'participantsBonusValue.integer' =>
                    'من فضلك تأكد من ادخال رقم صحيح لقيمة المشاركين في البحث',
            'participantsBonusValue.min' => 'يجب ألا يقل قيمة المشاركين في البحث عن رقم 0',
        ];

        if (App::getLocale() == 'ar') {
            Validator::make($request->all(),$rules,$arabicMessage)->validate();
        }
        else{
            Validator::make($request->all(),$rules)->validate();
        }

        $research->facultymemberId = $request->facultyMember;
        $research->researchName = $request->researchName;
        $research->magazine = $request->magazine;
        $research->publishDate = $request->publishDate;
        $research->publishPlace = $request->publishPlace;
        $research->effectCoefficient = $request->effectCoefficient;
        $research->bonusValue = $request->bonusValue;
        $research->participantsBonusValue = $request->participantsBonusValue;

        $research->save();

        return redirect('research/'.$research->id.'/edit')->with('sucess',__('message.Research Successfully Edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\research  $research
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $rules = [
            'id' => 'required|exists:researches',
        ];
        // if application is in arabic lang
        $arabicMessage = [
            'id.required' => 'لا يوجد بيانات لذلك البحث في قاعدة البيانات',
            'id.exists' => 'لا يوجد بيانات لذلك البحث في قاعدة البيانات',
        ];

        $engMessage = [
            'id.required' => 'This research doesn\'t exist in the Database',
            'id.exists' => 'This research doesn\'t exist in the Database',
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
            $research = research::find($request->id);
            $research->delete();
            $msg = __('message.Research Successfully Deleted');
            return response()->json(array('msg' => $msg));
        }
    }
}
