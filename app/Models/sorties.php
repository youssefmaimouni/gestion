<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sorties extends Model
{
    protected $fillable =[
        'date_doc',
        'attachement',
        'remise',
        'description'
    ];
    
    public function client()
    {
        return $this->belongsTo(clients::class, 'id_clt');
    }

    public function categorie()
    {
        return $this->belongsTo(categories::class, 'id_cat');
    }
   
    use HasFactory;
}
