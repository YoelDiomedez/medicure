<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
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
                Patient::query()
            )
            ->addColumn('buttons', "patients.buttons.option")
            ->rawColumns(['buttons'])
            ->toJson(); 
        }
        
        return view('patients.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $patient = New Patient;

        $patient->surnames       = $request->surnames;
        $patient->names          = $request->names;
        $patient->birthdate      = $request->birthdate;
        $patient->gender         = $request->gender;
        $patient->marital_status = $request->marital_status;
        $patient->document_type  = $request->document_type;
        $patient->document_numb  = $request->document_numb;

        $patient->allergies      = $request->allergies;              
        $patient->vaccines       = $request->vaccines;
        $patient->cellphone_num  = $request->cellphone_num;
        $patient->address        = $request->address;
        $patient->email          = $request->email;
        $patient->profession     = $request->profession;
        $patient->relative       = $request->relative;

        $patient->save();

        return $patient;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $patient->surnames       = $request->surnames;
        $patient->names          = $request->names;
        $patient->birthdate      = $request->birthdate;
        $patient->gender         = $request->gender;
        $patient->marital_status = $request->marital_status;
        $patient->document_type  = $request->document_type;
        $patient->document_numb  = $request->document_numb;

        $patient->allergies      = $request->allergies;              
        $patient->vaccines       = $request->vaccines;
        $patient->cellphone_num  = $request->cellphone_num;
        $patient->address        = $request->address;
        $patient->email          = $request->email;
        $patient->profession     = $request->profession;
        $patient->relative       = $request->relative;

        $patient->update();

        $user = User::where('patient_id', $patient->id)->first();

        if ($user) {

            $user->email     = $request->email;
            $user->specialty = $request->profession;
            $user->update();
        }
        
        return $patient;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return $patient;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        $data = [
            'id'            => $patient->id,
            'document_type' => $patient->document_type,
            'document_numb' => $patient->document_numb,
            'surnames'      => $patient->surnames,
            'names'         => $patient->names
        ]; 

        return $data;
    }
    
    public function get(Request $request)
    {
        $term = $request->term;

        $data = Patient::select('id', 'document_numb', 'document_type', 'surnames', 'names')
                        ->where('document_numb', 'LIKE', '%'.$term.'%')
                        ->orWhere('surnames', 'LIKE', '%'.$term.'%')
                        ->orWhere('names', 'LIKE', '%'.$term.'%')
                        ->paginate(10);

        $data->appends(['term' => $term]);

        return $data;
    }
}
