<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClausulasContrato extends Model
{
    use HasFactory;

    protected $table = 'clausulas_contrato';

    protected $fillable = [
        'clausula',
    ];

}
