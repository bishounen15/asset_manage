<?php

namespace App\FAMS;

use Illuminate\Database\Eloquent\Model;
use DB;

class Employee extends Model
{
    //
    protected $connection = 'fams';

    public function status() {
        return DB::connection('fams')
                    ->table('lookup_values')
                    ->where("tag","EMPLOYEE_STATUS")
                    ->limit(1)->offset($this->employee_status - 1)
                    ->first()->name;
    }

    public function department() {
        return $this->hasOne('App\FAMS\Department', 'id', 'department_id')->first()->name;
    }
}
