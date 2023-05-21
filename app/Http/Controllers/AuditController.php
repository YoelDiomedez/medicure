<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
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
                Audit::with(['user' => function ($query) {

                    $query->select('id', 'patient_id', 'position', 'specialty', 'email');

                }, 'user.patient' => function ($query) {

                    $query->select('id','names', 'surnames');

                }])->withCasts([
                    'created_at' => 'datetime:d/m/Y H:i:s',
                ])
            )
            ->addColumn('btnView', "<button id='viewAuditBtn' class='btn btn-info'><i class='fa fa-eye'></i> <span class='hidden-xs'>Detalles</span></button>")
            ->rawColumns(['btnView'])
            ->toJson(); 
        }
        
        return view('audits.index');
    }
}
