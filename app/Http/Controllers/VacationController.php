<?php

namespace App\Http\Controllers;

use App\vacation;
use App\facultyMembers;

use Illuminate\Http\Request;

use App;
use Validator;

class VacationController extends Controller
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
        $title = __('Heading.Vacationslist');

        $vacations = vacation::all();

        return view('Main.Vactions.VacationList',compact('title','vacations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = __('Heading.addNewVacations');

        $vacationTypes = $this->getJSONdata('vacationType');
        $countries = $this->getJSONdata('countries');
        $members = facultyMembers::all();

        return view('Main.Vactions.addNewVacation',compact('title','vacationTypes','countries','members'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vacationTypes = $this->getJSONdata('vacationType');
        $countries = $this->getJSONdata('countries');

        $rules = [
            'facultyMember' => 'required|exists:faculty_members,id',
            'description' => 'required|string|between:5,200',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
            'decisionDate' => 'nullable|date',
            'decisionNumber' => 'nullable|integer|min:1',
            'VacationType' => 'required|in:'.implode(',',$vacationTypes),
            'yearNumber' => 'required|integer|min:1',
            'countryName' => 'required|in:'.implode(',',$countries)
        ];
        //  if application is in arabic lang
        $arabicMessage = [
            'facultyMember.required' => 'من فضلك تأكد من اختيار عضو هيئة التدريس',
            'facultyMember.exists' => 'تأكد من اختيار عضو هيئة تدريس مخزن في قاعدة البيانات',

            'description.required' => 'من فضلك تأكد من ادخال وصف للاجازة المقدمة',
            'description.string' => 'من فضلك تأكد من ادخال قيمة نصية للوصف',
            'description.between' => 'يجب ألا يقل الوصف عن 5 حروف و ألا يزيد عن 200 حرف',

            'startDate.required' => 'من فضلك تأكد من ادخال تاريخ بداية الاجازة المقدمة',
            'startDate.date' => 'من فضلك تأكد من ادخال تاريخ صحيح',

            'endDate.required' => 'من فضلك تأكد من ادخال تاريخ نهاية الاجازة المقدمة',
            'endDate.date' => 'من فضلك تأكد من ادخال تاريخ صحيح',
            'endDate.after' => 'يجب ان يكون تاريخ انتهاء الاجازة بعد تاريخ بدايتها',

            'decisionDate.date' => 'من فضلك تأكد من ادخال تاريخ صحيح',

            'decisionNumber.integer' => 'من فضلك تأكد من ادخال رقم صحيح لرقم القرار',
            'decisionNumber.min' => 'يجب ألا يقل رقم القرار عن رقم 1',

            'VacationType.required' => 'من فضلك تأكد من ادخال نوع الاجازة المقدمة',
            'VacationType.in' => 'من فضلك تأكد من اختيار نوع اجازة من القائمة المقدمة',

            'yearNumber.required' => 'من فضلك تأكد من ادخال رقم السنة',
            'yearNumber.integer' =>  'من فضلك تأكد من ادخال رقم صحيح لرقم السنة',
            'yearNumber.min' => 'يجب ألا يقل رقم السنة عن رقم 1',

            'countryName.required' => 'من فضلك تأكد من ادخال البلد',
            'countryName.in' => 'من فضلك تأكد من اختيار نوع اجازة من القائمة المقدمة',
        ];

        if (App::getLocale() == 'ar') {
            Validator::make($request->all(),$rules,$arabicMessage)->validate();
        }
        else{
            Validator::make($request->all(),$rules)->validate();
        }

        $vacation = new vacation;

        $vacation->facultymemberId = $request->facultyMember;
        $vacation->description = $request->description;
        $vacation->startDate = $request->startDate;
        $vacation->endDate = $request->endDate;
        $vacation->decisionDate = $request->decisionDate;
        $vacation->decisionNumber = $request->decisionNumber;
        $vacation->VacationType = $request->VacationType;
        $vacation->yearNumber = $request->yearNumber;
        $vacation->countryName = $request->countryName;

        $vacation->save();

        return redirect('vacation/create')->with('sucess',__('message.Vacation Successfully Added'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function show(vacation $vacation)
    {
        $title = __('Heading.viewVacationData');
        return view('Main.Vactions.viewVacationData', compact('title','vacation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function edit(vacation $vacation)
    {
        $title = __('Heading.editVacationData');

        $vacationTypes = $this->getJSONdata('vacationType');
        $countries = $this->getJSONdata('countries');

        $members = facultyMembers::all();

        return view('Main.Vactions.editVacationData',
                compact('title','vacationTypes','countries','vacation','members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\vacation  $vacation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, vacation $vacation)
    {
        $vacationTypes = $this->getJSONdata('vacationType');
        $countries = $this->getJSONdata('countries');

        $rules = [
            'facultyMember' => 'required|exists:faculty_members,id',
            'description' => 'required|string|between:5,200',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after:startDate',
            'decisionDate' => 'nullable|date',
            'decisionNumber' => 'nullable|integer|min:1',
            'VacationType' => 'required|in:'.implode(',',$vacationTypes),
            'yearNumber' => 'required|integer|min:1',
            'countryName' => 'required|in:'.implode(',',$countries)
        ];
        //  if application is in arabic lang
        $arabicMessage = [
            'facultyMember.required' => 'من فضلك تأكد من اختيار عضو هيئة التدريس',
            'facultyMember.exists' => 'تأكد من اختيار عضو هيئة تدريس مخزن في قاعدة البيانات',

            'description.required' => 'من فضلك تأكد من ادخال وصف للاجازة المقدمة',
            'description.string' => 'من فضلك تأكد من ادخال قيمة نصية للوصف',
            'description.between' => 'يجب ألا يقل الوصف عن 5 حروف و ألا يزيد عن 200 حرف',

            'startDate.required' => 'من فضلك تأكد من ادخال تاريخ بداية الاجازة المقدمة',
            'startDate.date' => 'من فضلك تأكد من ادخال تاريخ صحيح',

            'endDate.required' => 'من فضلك تأكد من ادخال تاريخ نهاية الاجازة المقدمة',
            'endDate.date' => 'من فضلك تأكد من ادخال تاريخ صحيح',
            'endDate.after' => 'يجب ان يكون تاريخ انتهاء الاجازة بعد تاريخ بدايتها',

            'decisionDate.date' => 'من فضلك تأكد من ادخال تاريخ صحيح',

            'decisionNumber.integer' => 'من فضلك تأكد من ادخال رقم صحيح لرقم القرار',
            'decisionNumber.min' => 'يجب ألا يقل رقم القرار عن رقم 1',

            'VacationType.required' => 'من فضلك تأكد من ادخال نوع الاجازة المقدمة',
            'VacationType.in' => 'من فضلك تأكد من اختيار نوع اجازة من القائمة المقدمة',

            'yearNumber.required' => 'من فضلك تأكد من ادخال رقم السنة',
            'yearNumber.integer' =>  'من فضلك تأكد من ادخال رقم صحيح لرقم السنة',
            'yearNumber.min' => 'يجب ألا يقل رقم السنة عن رقم 1',

            'countryName.required' => 'من فضلك تأكد من ادخال البلد',
            'countryName.in' => 'من فضلك تأكد من اختيار نوع اجازة من القائمة المقدمة',
        ];

        if (App::getLocale() == 'ar') {
            Validator::make($request->all(),$rules,$arabicMessage)->validate();
        }
        else{
            Validator::make($request->all(),$rules)->validate();
        }

        $vacation->facultymemberId = $request->facultyMember;
        $vacation->description = $request->description;
        $vacation->startDate = $request->startDate;
        $vacation->endDate = $request->endDate;
        $vacation->decisionDate = $request->decisionDate;
        $vacation->decisionNumber = $request->decisionNumber;
        $vacation->VacationType = $request->VacationType;
        $vacation->yearNumber = $request->yearNumber;
        $vacation->countryName = $request->countryName;

        $vacation->save();

        return redirect('vacation/'.$vacation->id.'/edit')->with('sucess',__('message.Vacation Successfully Edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\vacation  $vacation
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        $rules = [
            'id' => 'required|exists:vacations',
        ];
        // if application is in arabic lang
        $arabicMessage = [
            'id.required' => 'لا يوجد بيانات لتلك الاجازة في قاعدة البيانات',
            'id.exists' => 'لا يوجد بيانات لتلك الاجازة في قاعدة البيانات',
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
            $vacation = vacation::find($request->id);
            $vacation->delete();
            $msg = __('message.Vacation Successfully Deleted');
            return response()->json(array('msg' => $msg));
        }
    }
}
