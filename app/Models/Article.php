<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'article',
        'designation',
        'category',
        'marque',
        'saveur',
        'is_active',
        'atelier_id'
    ];

    public function atelier()
    {
        return $this->belongsTo(Atelier::class, 'atelier_id');
    }

    public function productionX3s()
    {
        return $this->hasMany(ProductionX3::class, 'article', 'article');
    }
}
