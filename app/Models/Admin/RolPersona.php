<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolPersona extends Model
{
    use HasFactory;
    protected $fillable=['rol_id', 'persona_id'];

}
