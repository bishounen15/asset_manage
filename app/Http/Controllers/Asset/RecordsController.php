<?php

namespace App\Http\Controllers\Asset;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Asset\Record;

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
}
