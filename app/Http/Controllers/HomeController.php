<?php

namespace App\Http\Controllers;

use App\Models\Attention;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
    /**
     * Display a listing of the resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function triages(Request $request)
    {
        if($request->ajax()){
            
            return datatables()->eloquent(

                Attention::with(['patient:id,surnames,names'])
                        ->select('id', 'patient_id')
                        ->where('status', 'T')
            )
            ->addIndexColumn()
            ->toJson(); 
        }
    }

    /**
     * Display a listing of the resource.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function attentions(Request $request)
    {
        if($request->ajax()){
            
            return datatables()->eloquent(

                Attention::with(['patient:id,surnames,names'])
                        ->select('id', 'patient_id')
                        ->where('status', 'A')
            )
            ->addIndexColumn()
            ->toJson(); 
        }
    }
}
