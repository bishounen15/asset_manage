<?php

namespace App\Http\Controllers\Setup;

use App\Models\Setup\AssetStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Response;
use Validator;

class AssetStatusesController extends Controller
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
        $asset_stats = AssetStatus::select('id', 'description')
                        ->where("description","LIKE",'%'.$keyword.'%')
                        ->orderBy('description','asc')
                        ->paginate(10);

        return Response::json($asset_stats);
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
            'description' => 'required|unique:asset_statuses,description,'.$request->input('id'),
        ]);
        
        if ($validator->fails()) {
            return Response::json(['Errors' => $validator->errors()]);
        } else {
            $asset_stat = $request->isMethod('put') ? AssetStatus::findOrFail($request->id) : new AssetStatus;
            
            $asset_stat->id = $request->input('id');
            $asset_stat->description = $request->input('description');
            
            if($asset_stat->save()) {
                return Response::json(['Results' => $asset_stat, 'Errors' => $validator]);
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
        $asset_stat = AssetStatus::findOrFail($id);

        if($asset_stat->delete()) {
            return Response::json($asset_stat);
        }    
    }
}
