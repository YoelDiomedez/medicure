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

                }])
            )
            ->addColumn('btnView', "<button id='viewAuditBtn' class='btn btn-info'><i class='fa fa-eye'></i> <span class='hidden-xs'>Detalles</span></button>")
            ->rawColumns(['btnView'])
            ->editColumn('created_at', function (Audit $audit) {
                return $audit->created_at->tz(config('app.timezone'));
            })
            ->toJson(); 
        }
        
        return view('audits.index');
    }
}
