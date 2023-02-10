<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identification extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['id', 'number', 'archive', 'issueDate'];

    public function processe()
    {
        return $this->belongsTo(Process::class);
    }
}
