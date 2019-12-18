<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    //
    protected $fillable = [
        'id',
        'asset_id',
        'ip',
        'mac',
        'name',
        'descr',
        'interface',
    ];
}
