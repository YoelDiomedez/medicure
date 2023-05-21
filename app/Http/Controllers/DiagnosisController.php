<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
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
                Diagnosis::query()
            )
            ->addColumn('buttons', "diagnoses.buttons.option")
            ->rawColumns(['buttons'])
            ->toJson(); 
        }
        
        return view('diagnoses.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $diagnosis = new Diagnosis;

        $diagnosis->code    = $request->code;
        $diagnosis->disease = $request->disease;

        $diagnosis->save();

        return $diagnosis;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnosis $diagnosis)
    {
        $diagnosis->code    = $request->code;
        $diagnosis->disease = $request->disease;

        $diagnosis->update();

        return $diagnosis;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosis $diagnosis)
    {
        $diagnosis->delete();

        return $diagnosis;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diagnosis  $diagnosis
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnosis $diagnosis)
    {
        $data = [
            'id'      => $diagnosis->id,
            'code'    => $diagnosis->code,
            'disease' => $diagnosis->disease
        ]; 

        return $data;
    }

    public function get(Request $request)
    {
        $term = $request->term;

        $data = Diagnosis::select('id', 'code', 'disease')
                          ->where('code', 'LIKE', '%'.$term.'%')
                        ->orWhere('disease', 'LIKE', '%'.$term.'%')
                        ->paginate(10);

        $data->appends(['term' => $term]);

        return $data;
    }

    public function reinstate($id)
    {
        $diagnosis = Diagnosis::onlyTrashed()->findOrFail($id);

        $diagnosis->restore();
        
        return $diagnosis;
    }
}
