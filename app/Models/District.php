<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ["id", "name", "cod", "province_id"];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function neighbourhoods()
    {
        return $this->hasMany(Neighbourhood::class);
    }

    public function adresses()
    {
        return $this->hasMany(Adress::class);
    }
}
