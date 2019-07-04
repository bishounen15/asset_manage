<?php

namespace App\Http\Controllers\Setup;

use App\Models\Setup\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Response;
use Validator;

class PropertyTypesController extends Controller
{
    //
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
        $prop_types = PropertyType::select('id', 'description')
                        ->where("description","LIKE",'%'.$keyword.'%')
                        ->orderBy('description','asc')
                        ->paginate(10);

        return Response::json($prop_types);
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
            'description' => 'required|unique:property_types,description,'.$request->input('id'),
        ]);
        
        if ($validator->fails()) {
            return Response::json(['Errors' => $validator->errors()]);
        } else {
            $prop_type = $request->isMethod('put') ? PropertyType::findOrFail($request->id) : new PropertyType;
            
            $prop_type->id = $request->input('id');
            $prop_type->description = $request->input('description');
            
            if($prop_type->save()) {
                return Response::json(['Results' => $prop_type, 'Errors' => $validator]);
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
        $prop_type = PropertyType::findOrFail($id);

        if($prop_type->delete()) {
            return Response::json($prop_type);
        }    
    }
}
