<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Uuids;

    protected $table = 'categories';

    protected $fillable = ['id', 'name'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }
}
