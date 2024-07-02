<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
    protected $fillable =[
            'nom',
            'adresse',
            'telephone',
            'email',
            'num_fiscal',
            'compt_bancaire',
            'remarque',
            'remise',
    ];
    
    use HasFactory;
}
