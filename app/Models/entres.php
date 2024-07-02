<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entres extends Model
{
    use HasFactory;
    protected $fillable =[
        'quantite'
    ];

    public function marchandise()
    {
        return $this->belongsTo(marchandises::class, 'id_mar');
    }
   
    use HasFactory;
}
