<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcionMenu extends Model
{
    use HasFactory;
    protected $fillable=['nombre','ruta', 'orden', 'icono', 'grupo_menus_id'];


}
