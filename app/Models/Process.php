<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['id', 'user_id', 'address_id', 'identification_id', 'maritalState', 'genre', 'race', 'profession', 'workPlace', 'naturality', 'phoneNumber', 'fatherName', 'motherName'];

    public function identification()
    {
        return $this->belongsTo(Identification::class);
    }

    public function address()
    {
        return $this->belongsTo(Adress::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function consults()
    {
        return $this->hasMany(Consult::class);
    }
}
