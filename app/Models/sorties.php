<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sorties extends Model
{
    protected $fillable =[
        'quantite'
    ];
    public function marchandise()
    {
        return $this->belongsTo(marchandises::class, 'id_mar');
    }
    use HasFactory;
}
