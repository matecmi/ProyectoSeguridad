<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $fillable=[
        'fecha_registro',
        'fecha_inicio',
        'fecha_fin_estimado',
        'fecha_fin',
        'descripcion',
        'situacion',
        'usuario_id',
        'tipoincidencia_id',
        'sla_id'
    
    ];

}
