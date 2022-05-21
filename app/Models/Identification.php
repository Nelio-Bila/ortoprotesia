<?php

namespace App\Models;

use App\Models\Process;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Identification extends Model
{
    use HasFactory;

    protected $fillable = ["number", "archive", "issueDate"];

    public function processe()
    {
        return $this->belongsTo(Process::class);
    }
}
