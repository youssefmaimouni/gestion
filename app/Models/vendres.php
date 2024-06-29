<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendres extends Model
{
    protected $fillable =[
        'quantite'
    ];
    public function sortie()
    {
        return $this->belongsTo(sorties::class, 'id_sortie');
    }

    public function marchandise()
    {
        return $this->belongsTo(marchandises::class, 'id_mar');
    }
    use HasFactory;
}
