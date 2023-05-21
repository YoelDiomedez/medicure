<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;

class UserController extends Controller
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
                User::with([
                    'roles:id,name',
                    'patient:id,surnames,names,birthdate,gender,marital_status,document_type,document_numb,cellphone_num,address'
                ])
            )
            ->addColumn('buttons', "users.buttons.option")
            ->rawColumns(['buttons'])
            ->toJson(); 
        }
        
        return view('users.index');
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
        $patient->cellphone_num  = $request->cellphone_num;
        $patient->address        = $request->address;
        $patient->email          = $request->email;
        $patient->profession     = $request->specialty;

        $patient->save();

        $user =  New User;

        $user->patient_id = $patient->id;         
        $user->cmp        = $request->cmp;
        $user->rne        = $request->rne;
        $user->position   = $request->position;
        $user->specialty  = $request->specialty;
        $user->email      = $request->email;
        $user->password   = bcrypt($request->password);

        $user->save();

        $user->assignRole($request->role);

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $patient = Patient::withTrashed()->findOrFail($user->patient_id);

        $patient->surnames       = $request->surnames;
        $patient->names          = $request->names;
        $patient->birthdate      = $request->birthdate;
        $patient->gender         = $request->gender;
        $patient->marital_status = $request->marital_status;
        $patient->document_type  = $request->document_type;
        $patient->document_numb  = $request->document_numb;
        $patient->cellphone_num  = $request->cellphone_num;
        $patient->address        = $request->address;
        $patient->email          = $request->email;
        $patient->profession     = $request->specialty;

        $patient->update();

        $user->cmp        = $request->cmp;
        $user->rne        = $request->rne;
        $user->position   = $request->position;
        $user->specialty  = $request->specialty;
        $user->email      = $request->email;

        if ($request->password != null) {
            $user->password   = bcrypt($request->password);
        }

        $user->update();

        $user->syncRoles($request->role);
        
        return User::with([
            'permissions:id,name',
            'patient:id,surnames,names,birthdate,gender,marital_status,document_type,document_numb,cellphone_num,address'
        ])
        ->select('id', 'patient_id', 'cmp', 'rne', 'position', 'specialty', 'email')
        ->where('id', $request->id)
        ->firstOrFail(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $data = [
            'id'            => $user->id,
            'document_numb' => $user->patient->document_numb,
            'document_type' => $user->patient->document_type,
            'surnames'      => $user->patient->surnames,
            'names'         => $user->patient->names,
            'specialty'     => $user->specialty
        ]; 

        return $data;
    }
    
    public function get(Request $request)
    {

        $term = $request->term;

        $data = User::with(['patient' => function ($query) {

                    $query->select('id', 'surnames', 'names', 'document_numb');

                }])->whereHas('patient', function ($query) use ($term) {

                    $query->where('names', 'LIKE', '%'.$term.'%')
                        ->orWhere('surnames', 'LIKE', '%'.$term.'%')
                        ->orWhere('document_numb', 'LIKE', '%'.$term.'%');

                })
                ->select('position', 'specialty', 'patient_id', 'id')
                ->paginate(10);

        $data->appends(['term' => $term]);

        return $data;
    }
}
