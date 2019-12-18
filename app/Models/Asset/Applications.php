<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    //
    protected $fillable = [
        'id',
        'asset_id',
        'install_date',
        'app_name',
        'version',
        'install_type',
    ];
}
