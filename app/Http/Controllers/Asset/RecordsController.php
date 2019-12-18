<?php

namespace App\Http\Controllers\Asset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Asset\Record;
use App\Models\Asset\Network;
use App\Models\Asset\Disk;
use App\Models\Asset\Applications;

use DB;
use Response;
use Validator;

class RecordsController extends Controller
{
    //
    public function __construct()
    {
        date_default_timezone_set('Asia/Manila');
    }

    public function index($keyword = null)
    {
        //
        $records = Record::select('id', 'type', 'brand', 'model', 'serial', DB::raw("CONCAT(site, CASE IFNULL(sub_site,'') WHEN '' THEN '' ELSE CONCAT(' : ',sub_site) END ) AS site"), 'dept', DB::raw("CONCAT(id_number,' - ',name) as user"),'status','device_status')
                        ->orderByRaw('site, sub_site, dept, status')
                        ->paginate(10);

        return Response::json($records);
    }

    public function saveAsset(Request $request) {
        // dd($request);
        $asset_item = Record::updateOrCreate(
                            [
                                'serial' => $request->serial
                            ],
                            [
                                'type' => $request->type, 
                                'brand' => $request->brand,
                                'model' => $request->model,
                                'os' => $request->os,
                                'host_name' => $request->host_name,
                                'id_number' => $request->id_number,
                                'name' => $request->name,
                                'dept' => $request->dept,
                                'site' => $request->site,
                                'sub_site' => $request->sub_site,
                                'status' => $request->status,
                                'device_status' => $request->device_status,
                                'proc' => $request->proc,
                                'ram' => $request->ram,
                                'hdd' => $request->hdd,
                                'gfx_card' => $request->gfx_card,
                                'remarks' => $request->remarks,
                            ]
                        );

        return Response::json($asset_item);
    }

    public function saveNetwork(Request $request) {
        // dd($request);
        $asset_network = Network::updateOrCreate(
                    [
                        'asset_id' => $request->id,
                        'mac' => $request->mac,
                    ],
                    [
                        'ip' => $request->ip, 
                        'name' => $request->name,
                        'descr' => $request->descr,
                        'interface' => $request->interface,
                    ]
                );

        return Response::json($asset_network);
    }

    public function deleteNetwork(Request $request) {
        $deleted = Network::where("asset_id",$request->id)->whereNotIn("id",$request->IDs)->delete();
        return Response::json($deleted);
    }

    public function saveDisks(Request $request) {
        $asset_disk = Disk::updateOrCreate(
                    [
                        'asset_id' => $request->id,
                        'root_dir' => $request->root_dir,
                    ],
                    [
                        'capacity' => $request->capacity, 
                        'free_space' => $request->free_space,
                    ]
                );

        return Response::json($asset_disk);
    }

    public function deleteDisks(Request $request) {
        $deleted = Disk::where("asset_id",$request->id)->whereNotIn("id",$request->IDs)->delete();
        return Response::json($deleted);
    }

    public function saveApps(Request $request) {
        $asset_apps = Applications::updateOrCreate(
                    [
                        'asset_id' => $request->id,
                        'app_name' => $request->app_name,
                    ],
                    [
                        'install_date' => $request->install_date, 
                        'version' => $request->version,
                        'install_type' => $request->install_type,
                    ]
                );

        return Response::json($asset_apps);    
    }

    public function deleteApps(Request $request) {
        $deleted = Applications::where("asset_id",$request->id)->whereNotIn("id",$request->IDs)->delete();
        return Response::json($deleted);
    }

    public function getDetails($serial) {
        $details = Record::select("id_number","name","dept","status","site","device_status","remarks")
                            ->where("serial",$serial)
                            ->get();

        return $details;
    }
}
