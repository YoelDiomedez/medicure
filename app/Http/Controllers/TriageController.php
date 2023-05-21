<?php

namespace App\Http\Controllers;

use App\Models\Triage;
use App\Models\Attention;
use App\Events\AttentionStatus;
use Illuminate\Http\Request;

class TriageController extends Controller
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
                    'triage:id,attention_id',
                    'patient:id,surnames,names,document_type,document_numb,birthdate',
                    'service:id,concept',
                    'user.patient:id,surnames,names',
                    'employee.patient:id,surnames,names'
                ])->select('id', 'patient_id', 'service_id', 'user_id', 'employee_id', 'amount', 'created_at')
                   ->where('status', 'T')
                   ->withCasts([
                        'created_at' => 'datetime:d/m/Y H:i:s',
                    ])
            )
            ->addIndexColumn()
            ->addColumn('buttons', "triages.buttons.option")
            ->rawColumns(['buttons'])
            ->toJson(); 
        }
        
        return view('triages.index');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Triage  $triage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Triage $triage)
    {
        $triage->weight            = $request->weight;
        $triage->height            = $request->height;
        $triage->bmi               = $request->bmi;
        $triage->temperature       = $request->temperature;
        $triage->heart_rate        = $request->heart_rate;
        $triage->respiratory_rate  = $request->respiratory_rate;
        $triage->blood_pressure    = $request->blood_pressure;
        $triage->oxygen_saturation = $request->oxygen_saturation;

        $triage->update();

        $attention = Attention::find($triage->attention_id);
        $attention->status = 'A'; // Ready for Attention
        $attention->update();
        
        event(new AttentionStatus($attention->status));

        return $triage;
    }
}
