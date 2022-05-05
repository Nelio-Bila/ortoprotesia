<?php

namespace App\Models;

use App\Models\Adress;
use App\Models\Identification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Process extends Model
{
    use HasFactory;

    public function identification()
    {
        return $this->hasMany(Identification::class);
    }

    public function address()
    {
        return $this->hasOne(Adress::class);
    }
}
