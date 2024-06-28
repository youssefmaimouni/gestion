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
        'descreption'
    ];
    public function document()
    {
        return $this->belongsTo(documents::class, 'id_doc');
    }
    public function client()
    {
        return $this->belongsTo(clients::class, 'id_clt');
    }
    use HasFactory;
}
