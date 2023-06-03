<?php

namespace App\Http\Controllers;

use App\Models\Attention;
use App\Libraries\Prince;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $patient = ($request->patient) ? $request->patient : null ;

        if($request->ajax()){

            return datatables()->eloquent(
                Attention::select('id', 'created_at')
                          ->where('status', 'D')
                          ->where('patient_id', $patient)
            )
            ->addColumn('buttons', "histories.buttons.option")
            ->rawColumns(['buttons'])
            ->editColumn('created_at', function (Attention $attention) {
                return $attention->created_at->tz(config('app.timezone'));
            })
            ->toJson(); 
        }

        return view('histories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attention  $attention
     * @return \App\Libraries\Prince
     */
    public function record(Attention $attention)
    {
        $record = Attention::where('id', $attention->id)
                           ->where('status', 'D')
                           ->firstOrFail();

        $html = view('histories.record', compact('record'))->render();
         

    	$prince = new Prince(config('app.name', 'Laravel') . ' | Historias');
        $prince->generate($html);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attention  $attention
     * @return \App\Libraries\Prince
     */
    public function prescription(Request $request, Attention $attention)
    {  
        $recipe = Attention::where('id', $attention->id)
                                 ->where('status', 'D')
                                 ->firstOrFail();

        $html = view('histories.prescription', compact('recipe'))->render();

        $prince = new Prince(config('app.name', 'Laravel') . ' | Recetas');
        $prince->generate($html);
    }
}
