<?php

namespace App\Models;

use App\Models\Process;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adress extends Model
{
    use HasFactory;

    protected $fillable = ["province", "district", "neighbourhood", 'processe_id'];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}
