<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Record;
use App\Models\Surgery;
use App\Models\Attention;
use App\Models\Prescription;
use App\Events\AttentionStatus;
use Illuminate\Http\Request;

class RecordController extends Controller
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
                    'record:id,attention_id',
                    'triage:id,attention_id,height,weight,bmi,temperature,heart_rate,respiratory_rate,blood_pressure,oxygen_saturation',
                    'patient:id,surnames,names,document_type,document_numb,birthdate',
                    'service:id,concept',
                    'user.patient:id,surnames,names',
                    'employee.patient:id,surnames,names'
                ])->select('id', 'patient_id', 'service_id', 'user_id', 'employee_id', 'amount', 'created_at')
                   ->where('status', 'A')
                   ->withCasts([
                        'created_at' => 'datetime:d/m/Y H:i:s',
                    ])
            )
            ->addIndexColumn()
            ->addColumn('buttons', "records.buttons.option")
            ->rawColumns(['buttons'])
            ->toJson(); 
        }
        
        return view('records.index'); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        // Actualiza los campos en null de la tabla records
        $record->symptom                  = $request->symptom;
        $record->history                  = $request->history;
        $record->physiological_background = $request->physiological_background;
        $record->pathological_background  = $request->pathological_background;
        $record->treatment                = $request->treatment;
        $record->instruction              = $request->instruction;
        $record->physical_exam            = $request->physical_exam;
        $record->auxiliary_exams          = $request->auxiliary_exams;

        $record->update();

        // Inserta el/los diagnóstico(s) con sus respectivos tipos
        $type      = $request->types;
        $pivot     = array();
        $diagnoses = $request->diagnoses;

        for ($i=0; $i < count($diagnoses); $i++) { 

            $pivot[$i] = array('type' => $type[$i]);
        }
        
        $sync = array_combine($diagnoses, $pivot);

        $record->diagnoses()->sync($sync);

        // Inserta la(s) receta(s) de una atención
        $drugs       = $request->drugs;
        $amounts     = $request->amounts;
        $shapes      = $request->shapes;
        $notes       = $request->notes;
        $doses       = $request->doses;
        $routes      = $request->routes;
        $frequencies = $request->frequencies;
        $terms       = $request->terms;

        for ($i=0; $i < count($drugs); $i++) { 

            $prescription = new Prescription;

            $prescription->attention_id = $record->attention_id;
            $prescription->drug         = $drugs[$i];
            $prescription->amount       = $amounts[$i];
            $prescription->shape        = $shapes[$i];
            $prescription->note         = $notes[$i];
            $prescription->dose         = $doses[$i];
            $prescription->route        = $routes[$i];
            $prescription->frequency    = $frequencies[$i];
            $prescription->term         = $terms[$i];

            $prescription->save();
        }
        
        $attention = Attention::find($record->attention_id);
        $attention->status = 'D'; // Attention done
        $attention->update();

        event(new AttentionStatus($attention->status));

        return $record;
    }
}
