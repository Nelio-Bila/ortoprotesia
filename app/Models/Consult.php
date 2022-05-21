<?php

namespace App\Models;

use App\Models\Process;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consult extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'date', 'process_id', 'accomplished'];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}