<?php

namespace App\Models;

use App\Models\Process;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adress extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ["id", "province_id", "district_id", "neighbourhood_id"];

    public function process()
    {
        return $this->hasMany(Process::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }


    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }


    public function neighbourhood()
    {
        return $this->belongsTo(Neighbourhood::class, 'neighbourhood_id', 'id');
    }
}