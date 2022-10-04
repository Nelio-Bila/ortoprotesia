<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleView extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'who->id', 'who->type'];

    public function article()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

    protected $casts = [
        'who' => 'array'
    ];

    public function setWhosAttribute($value)
    {
        $who = [];

        foreach ($value as $array_item) {
            if (!is_null($array_item['key'])) {
                $who[] = $array_item;
            }
        }

        $this->attributes['who'] = json_encode($who);
    }
}