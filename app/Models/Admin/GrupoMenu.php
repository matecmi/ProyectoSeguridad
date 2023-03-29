<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoMenu extends Model
{
    use HasFactory;
    protected $fillable=['nombre','icono', 'orden'];


}
