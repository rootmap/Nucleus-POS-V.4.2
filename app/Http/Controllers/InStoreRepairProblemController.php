<?php

namespace App\Http\Controllers;

use App\InStoreRepairProblem;
use Illuminate\Http\Request;

class InStoreRepairProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    private $moduleName="In Store Repair Problem Settings ";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

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
     * @param  \App\InStoreRepairProblem  $inStoreRepairProblem
     * @return \Illuminate\Http\Response
     */
    public function edit($id=0)
    {
        $tab=\DB::table('in_store_repair_problems')->where('id',$id)->first();
        return view('apps.pages.instorerepair.settings.problem',compact('tab'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InStoreRepairProblem  $inStoreRepairProblem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id=0)
    {
        //echo $id; die();
        $tab=\DB::table('in_store_repair_problems')
                ->where('id',$id)
                ->update(['name'=>$request->problem_name,'updated_by'=>$this->sdc->UserID()]);
        return redirect('settings/instore/problem/list')
                 ->with('success','Problem Name Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InStoreRepairProblem  $inStoreRepairProblem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {
        $tab=\DB::table('in_store_repair_problems')
                ->where('id',$id)
                ->delete();
        return redirect('settings/instore/problem/list')
                 ->with('success','Problem Name Deleted Successfully.');
    }
}
