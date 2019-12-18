<?php

namespace App\Http\Controllers\Setup;

use App\Models\Setup\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Response;
use Validator;

class SitesController extends Controller
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
        $sites = Site::select('sites.id', 'sites.description', 'sites.parent_id', 'parent_sites.description as parent_site')
                        ->leftJoin('sites as parent_sites','sites.parent_id','parent_sites.id')
                        ->where("sites.description","LIKE",'%'.$keyword.'%')
                        ->orWhere("parent_sites.description","LIKE",'%'.$keyword.'%')
                        ->orderByRaw("IFNULL(parent_sites.description,sites.description) ASC, CASE WHEN parent_sites.description IS NULL THEN '' ELSE sites.description END ASC")
                        ->paginate(10);

        return Response::json($sites);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function parentSites()
    {
        //
        $sites = Site::select('id', 'description', 'parent_id')
                        ->where("parent_id",0)
                        ->orderBy('description','asc')->get();

        return Response::json(["data" => $sites]);
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
            'description' => 'required|unique:sites,description,'.$request->input('id').',id,parent_id,'.$request->input('parent_id'),
            'parent_id' => 'required|integer',
        ], [
            'description.required' => 'The site field is required',
            'description.unique' => 'This site already exists',
        ]);
        
        if ($validator->fails()) {
            return Response::json(['Errors' => $validator->errors()]);
        } else {
            $site = $request->isMethod('put') ? Site::findOrFail($request->id) : new Site;
            
            $site->id = $request->input('id');
            $site->description = $request->input('description');
            $site->parent_id = $request->input('parent_id');

            if($site->save()) {
                return Response::json(['Results' => $site, 'Errors' => $validator]);
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
        $site = Site::findOrFail($id);

        if($site->delete()) {
            return Response::json($site);
        }    
    }

    public function list() {
        //"CONCAT(IFNULL(parent_sites.description,''),CASE WHEN parent_sites.id IS NULL THEN '' ELSE ' : ' END,sites.description) AS description"
        $sites = Site::leftjoin("sites as parent_sites","sites.parent_id","parent_sites.id")
                        ->selectRaw("sites.description")
                        ->orderByRaw("IFNULL(parent_sites.description,sites.description) ASC, CASE WHEN parent_sites.description IS NULL THEN '' ELSE sites.description END ASC")
                        ->get();

        return $sites;
    }

    public function getSubsites($site) {
        $subsites = Site::join("sites as parent_sites", "sites.parent_id", "parent_sites.id")
                            ->selectRaw("sites.description")
                            ->where([
                                ["parent_sites.parent_id",0],
                                ["parent_sites.description",$site],
                            ])->orderBy("sites.description","ASC")
                            ->get();

        return $subsites;
    }
}
