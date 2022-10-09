<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultDate extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['id', 'type', 'date', 'accomplished_at'];
}
