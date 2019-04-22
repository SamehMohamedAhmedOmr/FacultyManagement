<?php

use Illuminate\Support\Arr;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('setlocale/{locale}', function ($locale) {
    if (in_array($locale, \Config::get('app.locales'))) {
        //Session::put('locale', $locale);
        return redirect()->back()->withCookie(cookie()->forever('locale', $locale));
    }
    return redirect()->back()->withCookie(cookie()->forever('locale', 'en')); // default
});

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        $title = '';
        return view('auth.login',compact('title'));
    });
    Route::get('login', function () {
        $title = '';
        return view('auth.login',compact('title'));
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('/dashboard');
    });

    Route::get('register', function () {
        return redirect('/dashboard');
    });

    Route::get('dashboard', function () {
        $title = __('Heading.Dashboard');

        $memberCounts = \App\facultyMembers::count();
        $vacationCounts = \App\vacation::count();
        $discussionCounts = \App\discussion::count();
        $researchCounts = \App\research::count();

        return view('Main.Statistics.dashboard',compact('title','memberCounts','vacationCounts','discussionCounts','researchCounts'));
    });


    Route::get('dashboard/members', function () {
        $title = __('Statistics.memberStat');

        $memberStatistics = DB::select('SELECT `job`, COUNT(*) as `counts` FROM `faculty_members` GROUP BY `job`');

        return view('Main.Statistics.membersStat',compact('title','memberStatistics'));
    });

    Route::get('dashboard/vacations', function () {
        $title = __('Statistics.vacationStat');

        $vacationStatistics = DB::select('SELECT `VacationType`, COUNT(*) as `counts` FROM `vacations` GROUP BY `VacationType`');

        return view('Main.Statistics.vacationStat',compact('title','vacationStatistics'));
    });

    Route::get('dashboard/discussions', function () {
        $title = __('Statistics.discussionStat');

        $discussionStatistics = DB::select('SELECT `department`, COUNT(*) as `counts` FROM `discussions` GROUP BY `department`');

        return view('Main.Statistics.disucussionStat',compact('title','discussionStatistics'));
    });

    Route::get('dashboard/researches', function () {
        $title = __('Statistics.researchStat');

        $researchStatistics = DB::select('SELECT SUBSTR(`publishDate`, 1,4) as year , COUNT(*) as `counts` from `researches` GROUP BY SUBSTR(`publishDate`, 1,4)');

        return view('Main.Statistics.researchStat',compact('title','researchStatistics'));
    });

    Route::resource('facultyMember', 'FacultyMembersController');

    Route::resource('vacation', 'VacationController');

    Route::resource('research', 'ResearchController');

    Route::resource('discussion', 'DiscussionController');

});

Auth::routes();

