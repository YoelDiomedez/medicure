<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
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
                Role::with(['permissions:id,name'])
            )
            ->addColumn('buttons', "roles.buttons.option")
            ->rawColumns(['buttons'])
            ->toJson(); 
        }
        
        return view('roles.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role;

        $role->name = $request->name;

        $role->save();

        $role->syncPermissions($request->permissions);

        return $role;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->name  = $request->name;

        $role->update();

        $role->syncPermissions($request->permissions);

        return $role;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return $role;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $data = [
            'id'   => $role->id,
            'name' => $role->name
        ]; 

        return $data;
    }
    
    public function get(Request $request)
    {
        $term = $request->term;

        $data = Role::select('id', 'name')
                     ->where('name', 'LIKE', '%'.$term.'%')
                     ->paginate(10);

        $data->appends(['term' => $term]);

        return $data;
    }
}
