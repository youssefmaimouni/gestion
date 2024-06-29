<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acheters extends Model
{
    protected $fillable =[
        'quantite'
    ];
    
    use HasFactory;
    public function entre()
    {
        return $this->belongsTo(entres::class, 'id_entre');
    }

    public function marchandise()
    {
        return $this->belongsTo(marchandises::class, 'id_mar');
    }
}
