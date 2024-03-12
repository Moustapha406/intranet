<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Article extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

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