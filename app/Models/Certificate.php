<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['id', 'name', 'health_professional_id'];

    public function health_professional()
    {
        return $this->belongsTo(HealthProfessional::class);
    }
}
