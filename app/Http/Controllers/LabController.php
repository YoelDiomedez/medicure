<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Libraries\Prince;
use Illuminate\Http\Request;

class LabController extends Controller
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

                Lab::with([
                    'patient',
                    'service',
                    'user.patient',
                ])
            )
            ->addColumn('buttons', "labs.buttons.option")
            ->rawColumns(['buttons'])
            ->editColumn('updated_at', function (Lab $lab) {
                return $lab->updated_at->tz(config('app.timezone'));
            })
            ->toJson(); 
        }
        
        return view('labs.index'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lab = new Lab;

        $lab->patient_id = $request->patient;
        $lab->service_id = $request->service;
        $lab->user_id    = auth()->user()->id;
        $lab->amount     = $request->amount;
        $lab->report     = $request->report;

        $lab->save();    

        return $lab;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function show(Lab $lab)
    {
        $html = view('labs.show', compact('lab'))->render();

    	$prince = new Prince(config('app.name', 'Laravel') . ' | Informe de Laboratorial');
        
        return response()->file($prince->generate($html));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lab $lab)
    {
        $lab->patient_id = $request->patient;
        $lab->service_id = $request->service;
        $lab->user_id    = auth()->user()->id;
        $lab->amount     = $request->amount;
        $lab->report     = $request->report;

        $lab->update();

        return Lab::with([
            'patient',
            'service',
            'user.patient',
        ])->find($request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lab $lab)
    {
        $lab->delete();

        return $lab;
    }
}
