<?php

namespace App\FAMS;

use Illuminate\Database\Eloquent\Model;
use DB;

class Assets extends Model
{
    //
    protected $connection = 'fams';

    public function site() {
        return $this->hasOne('App\FAMS\Site', 'id', 'site_id')->first()->name;
    }

    public function employee() {
        return $this->hasOne('App\FAMS\Employee', 'id', 'employee_id')->select("employee_no","full_name","department_id")->first();
    }

    public function status() {
        return DB::connection('fams')
                    ->table('lookup_values')
                    ->where("tag","ASSET_STATUS")
                    ->limit(1)->offset($this->status - 1)
                    ->first()->name;
    }

    public function category() {
        return $this->hasOne('App\FAMS\Category', 'id', 'category_id')->first();
    }

    public function subcategory() {
        return $this->hasOne('App\FAMS\Category', 'id', 'subcategory_id')->first();
    }
}
