<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entres extends Model
{
    protected $fillable =[
        'date_doc',
        'attachement',
        'descreption',
        
    ];
    
    public function fournisseur()
    {
        return $this->belongsTo(fournisseurs::class, 'id_four');
    }
   
    use HasFactory;
}
