<?php

namespace App\Http\Controllers\Setup;

use App\Models\Setup\AssetType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Response;
use Validator;

class AssetTypesController extends Controller
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
        $asset_types = AssetType::select('id', 'description','abbrev')
                        ->where("description","LIKE",'%'.$keyword.'%')
                        ->orderBy('description','asc')
                        ->paginate(10);

        return Response::json($asset_types);
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
            'description' => 'required|unique:asset_types,description,'.$request->input('id'),
            'abbrev' => 'required|unique:asset_types,abbrev,'.$request->input('id'),
        ]);
        
        if ($validator->fails()) {
            return Response::json(['Errors' => $validator->errors()]);
        } else {
            $asset_type = $request->isMethod('put') ? AssetType::findOrFail($request->id) : new AssetType;
            
            $asset_type->id = $request->input('id');
            $asset_type->description = $request->input('description');
            $asset_type->abbrev = $request->input('abbrev');

            if($asset_type->save()) {
                return Response::json(['Results' => $asset_type, 'Errors' => $validator]);
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
        $asset_type = AssetType::findOrFail($id);

        if($asset_type->delete()) {
            return Response::json($asset_type);
        }    
    }
}
