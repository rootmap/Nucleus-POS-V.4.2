<?php

namespace App\Http\Controllers;

use App\TicketProblem;
use Illuminate\Http\Request;

class TicketProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Ticket Problem";
    private $sdc;
    public function __construct(){ $this->sdc = new StaticDataController(); }

    public function index()
    {
        $tab=TicketProblem::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.ticket.problem',['dataTable'=>$tab]);
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
        $this->validate($request,[
            'name'=>'required',
        ]);


        $tab=new TicketProblem;
        $tab->name=$request->name;
        $tab->store_id=$this->sdc->storeID();
        $tab->created_by=$this->sdc->UserID();
        $tab->save();

        $this->sdc->log("Ticket Problem","Ticket Problem created");
        return redirect('settings/ticket/problem')->with('status', $this->moduleName.' Added Successfully !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TicketProblem  $ticketProblem
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $tab=TicketProblem::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.ticket.problem',['dataTable'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TicketProblem  $ticketProblem
     * @return \Illuminate\Http\Response
     */
    public function edit($id=0)
    {
        $tab=TicketProblem::find($id);
        $tabData=TicketProblem::where('store_id',$this->sdc->storeID())->get();
        return view('apps.pages.ticket.problem',['dataRow'=>$tab,'dataTable'=>$tabData,'edit'=>true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TicketProblem  $ticketProblem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=0)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);

        $tab=TicketProblem::find($id);
        $tab->name=$request->name;
        $tab->updated_by=$this->sdc->UserID();
        $tab->save();
        $this->sdc->log("Ticket Problem","Ticket Problem updated");
        return redirect('settings/ticket/problem')->with('status', $this->moduleName.' Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TicketProblem  $ticketProblem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=0)
    {
        $tab=TicketProblem::find($id);
        $tab->delete();
        $this->sdc->log("Ticket Problem","Ticket Problem deleted");
        return redirect('settings/ticket/problem')->with('status', $this->moduleName.' Deleted Successfully !');
    }
}
