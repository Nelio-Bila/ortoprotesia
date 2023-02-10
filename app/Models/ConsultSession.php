<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultSession extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'id',
        'type', 'date', 'accomplished', 'admin_id', 'admin_id',
    ];
}
