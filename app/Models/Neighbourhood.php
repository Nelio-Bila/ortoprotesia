<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neighbourhood extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['id', "name", "cod", "district_id"];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function adresses()
    {
        return $this->hasMany(Adress::class);
    }
}
