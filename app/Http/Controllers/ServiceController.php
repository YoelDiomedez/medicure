<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
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
                Service::query()
            )
            ->addColumn('buttons', "services.buttons.option")
            ->rawColumns(['buttons'])
            ->toJson();
        }
        
        return view('services.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = new Service;

        $service->concept = $request->concept;
        $service->amount  = $request->amount;

        $service->save();

        return $service;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $service->concept = $request->concept;
        $service->amount  = $request->amount;

        $service->update();

        return $service;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return $service;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $data = [
            'id'      => $service->id,
            'concept' => $service->concept,
            'amount'  => $service->amount
        ]; 

        return $data;
    }
    
    public function get(Request $request)
    {
        $term = $request->term;

        $data = Service::select('id', 'concept', 'amount')
                        ->where('concept', 'LIKE', '%'.$term.'%')
                        ->paginate(10);

        $data->appends(['term' => $term]);

        return $data;
    }
}
