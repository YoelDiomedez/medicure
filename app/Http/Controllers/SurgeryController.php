<?php

namespace App\Http\Controllers;

use App\Models\Surgery;
use App\Libraries\Prince;
use Illuminate\Http\Request;

class SurgeryController extends Controller
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

                Surgery::with([
                    'patient',
                    'preDiagnosis',
                    'postDiagnosis',
                    'users.patient'
                ])
            )
            ->addColumn('buttons', "surgeries.buttons.option")
            ->rawColumns(['buttons'])
            ->toJson(); 
        }
        
        return view('surgeries.index'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $surgery = new Surgery;

        $surgery->patient_id         = $request->patient;
        $surgery->pre_diagnosis_id   = $request->pre_diagnosis;
        $surgery->post_diagnosis_id  = $request->post_diagnosis;
        $surgery->date               = $request->date;
        $surgery->start_time         = $request->start_time;
        $surgery->end_time           = $request->end_time;
        $surgery->bed_num            = $request->bed_num;
        $surgery->anesthesia_type    = $request->anesthesia_type;
        $surgery->procedure_findings = $request->procedure_findings;
        $surgery->oxygen_use         = $request->oxygen_use;
        $surgery->equipment          = $request->equipment;
        $surgery->supplies           = $request->supplies;
        $surgery->observations       = $request->observations;
        $surgery->amount             = $request->amount;

        $surgery->save();

        $surgery->users()->sync($request->employees);

        return $surgery;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Surgery  $surgery
     * @return \Illuminate\Http\Response
     */
    public function show(Surgery $surgery)
    {
        $html    = view('surgeries.show', compact('surgery'))->render();
        $prince  = new Prince(config('app.name', 'Laravel') . ' | Informe Operatorio-Quirúrgico');
        $pdfpath = $prince->generate($html);

        return response()->file($pdfpath);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Surgery  $surgery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surgery $surgery)
    {
        $surgery->patient_id         = $request->patient;
        $surgery->pre_diagnosis_id   = $request->pre_diagnosis;
        $surgery->post_diagnosis_id  = $request->post_diagnosis;
        $surgery->date               = $request->date;
        $surgery->start_time         = $request->start_time;
        $surgery->end_time           = $request->end_time;
        $surgery->bed_num            = $request->bed_num;
        $surgery->anesthesia_type    = $request->anesthesia_type;
        $surgery->procedure_findings = $request->procedure_findings;
        $surgery->oxygen_use         = $request->oxygen_use;
        $surgery->equipment          = $request->equipment;
        $surgery->supplies           = $request->supplies;
        $surgery->observations       = $request->observations;
        $surgery->amount             = $request->amount;

        $surgery->update();
        $surgery->users()->sync($request->employees);

        return Surgery::with([
            'patient',
            'preDiagnosis',
            'postDiagnosis',
            'users.patient'
        ])->find($request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Surgery  $surgery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surgery $surgery)
    {
        $surgery->delete();

        return $surgery;
    }
}
