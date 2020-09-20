<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class espMed extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_medico', 'id_especialidade',
    ];
}
