<?php

namespace App\Http\Controllers;

use App\Calendar;
use App\Holiday;
use Illuminate\Http\Request;
use App\Members;
use App\Shifts;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $month = $request -> month;

        $year = $request -> year;

        $group_id = $request -> group_id;

        if ($year == null) {
            // request 出来なかった場合
            $year = date("Y");

            $month = date("m");

        }
        //取得方法考え中
        $group_id = 1;

        $lastDay = date("t", mktime(0, 0, 0, $month, 1, $year));

        $Hol_list = holiday::select('day') -> get();
        $Mem_list = members::where('group_id',$group_id) -> where('year',$year) -> where('month',$month) -> select('id','name','type') -> get();
        $shi_list = shifts::where('group_id',$group_id) -> select('shift_id','name') -> get();

        //\Debugbar::info($shi_list);

        $Shi = new Shifts();
        $Mem = new Members();

        //リストを作成する
        $member_list = $Shi -> shifts_create($year, $month, $group_id, $lastDay, $Hol_list, $Mem_list, $shi_list);

        //作成したリストをDBに保存する
        $Mem -> shifts_update($year, $month, $group_id, $member_list);

        return redirect('/');

        //return view('members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param $member
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('members.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request)
    {



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

    public function getCount(Members $members)
    {

    }

}
