<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //
    protected $fillable = [
        'serial',
        'type',
        'brand',
        'model',
        'os',
        'host_name',
        'id_number',
        'name',
        'dept',
        'site',
        'sub_site',
        'status',
        'device_status',
        'proc',
        'ram',
        'hdd',
        'gfx_card',
        'remarks',
    ];
}
