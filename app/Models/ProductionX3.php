<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionX3 extends Model
{

    use HasFactory;

    protected $table = "production_x3";

    protected $fillable = [
        'numSuivi',
        'article',
        'qty'
    ];



    public function articles()
    {
        return $this->belongsTo(Article::class, 'article', 'article');
    }
}
