<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionJour extends Model
{
    use HasFactory;

    protected $fillable = [

        'nbreQuarts',
        'qtyProd',
        'TRGjour',
        'usine',
        'observation',
        'dateProd',
        'atelier_id'
    ];

    public function atelier()
    {
        return $this->belongsTo(Atelier::class);
    }
}
