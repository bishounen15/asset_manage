<?php

namespace App\Http\Controllers\Setup;

use App\Models\Setup\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Response;
use Validator;

class DepartmentsController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Manila');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($keyword = null)
    {
        //
        $depts = Department::select('id', 'description','abbrev')
                        ->where("description","LIKE",'%'.$keyword.'%')
                        ->orderBy('description','asc')
                        ->paginate(10);

        return Response::json($depts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = null;

        $validator = Validator::make($request->all(), [
            'description' => 'required|unique:departments,description,'.$request->input('id'),
            'abbrev' => 'required|unique:departments,abbrev,'.$request->input('id'),
        ]);
        
        if ($validator->fails()) {
            return Response::json(['Errors' => $validator->errors()]);
        } else {
            $dept = $request->isMethod('put') ? Department::findOrFail($request->id) : new Department;
            
            $dept->id = $request->input('id');
            $dept->description = $request->input('description');
            $dept->abbrev = $request->input('abbrev');

            if($dept->save()) {
                return Response::json(['Results' => $dept, 'Errors' => $validator]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $dept = Department::findOrFail($id);

        if($dept->delete()) {
            return Response::json($dept);
        }    
    }
}
