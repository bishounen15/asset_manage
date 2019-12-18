<?php

namespace App\Models\Asset;

use Illuminate\Database\Eloquent\Model;

class Disk extends Model
{
    //
    protected $fillable = [
        'id',
        'asset_id',
        'root_dir',
        'capacity',
        'free_space',
    ];
}
