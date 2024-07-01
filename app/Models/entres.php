<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entres extends Model
{
    protected $fillable =[
        'date_doc',
        'attachement',
        'description',
        
    ];
    
    public function fournisseur()
    {
        return $this->belongsTo(fournisseurs::class, 'id_four');
    }
    public function categorie()
    {
        return $this->belongsTo(categories::class, 'id_cat');
    }
   
    use HasFactory;
}
