<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;
    /*
    * @var array
     */
    protected $fillable = [
        'crm_medico', 'nome_medico', 'dn_medico',
    ];
}
