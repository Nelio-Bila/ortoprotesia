<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ["id", "name", "cod"];

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function adresses()
    {
        return $this->hasMany(Adress::class);
    }
}
