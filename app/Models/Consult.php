<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['id', 'process_id', 'accomplished', 'consult_session_id'];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function consultSession()
    {
        return $this->belongsTo(ConsultSession::class);
    }

    protected $dates = ['created_at', 'updated_at'];

    protected $appends = ['createdDateHumanReadable'];

    public function getCreatedDateHumanReadableAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
