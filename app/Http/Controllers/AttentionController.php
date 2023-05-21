<?php

namespace App\Http\Controllers;

use App\Models\Triage;
use App\Models\Record;
use App\Models\Attention;
use App\Events\AttentionStatus;
use Illuminate\Http\Request;

class AttentionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            return datatables()->eloquent(
                Attention::with([
                    'patient:id,surnames,names,document_type,document_numb,birthdate',
                    'service:id,concept',
                    'user.patient:id,surnames,names',
                    'employee.patient:id,surnames,names'
                ])
            )
            ->addColumn('buttons', "attentions.buttons.option")
            ->rawColumns(['buttons'])
            ->toJson(); 
        }
        
        return view('attentions.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attention = new Attention;

        $attention->patient_id  = $request->patient;
        $attention->service_id  = $request->service;
        $attention->user_id     = auth()->user()->id;
        $attention->employee_id = $request->employee;
        $attention->amount      = $request->amount;
        $attention->status      = 'T'; // Ready for Triage

        $attention->save();

        $triage = new Triage;
        $record = new Record;

        $triage->attention_id = $attention->id;
        $record->attention_id = $attention->id;

        $triage->save();      
        $record->save();      

        event(new AttentionStatus($attention->status));

        return $attention;
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attention  $attention
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attention $attention)
    {
        $attention->patient_id  = $request->patient;
        $attention->service_id  = $request->service;
        $attention->user_id     = auth()->user()->id;
        $attention->employee_id = $request->employee;
        $attention->amount      = $request->amount;

        $attention->update();

        event(new AttentionStatus($attention->status));

        return Attention::with([
            'patient:id,surnames,names,document_type,document_numb,birthdate',
            'service:id,concept',
            'user.patient:id,surnames,names',
            'employee.patient:id,surnames,names'
        ])->find($request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attention  $attention
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attention $attention)
    {
        $attention->delete();

        event(new AttentionStatus($attention->status));

        return $attention;
    }
}
