<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tblcliente extends Model
{
    use HasFactory;

    protected $table = 'tblclientes';

    protected $primaryKey = 'ClienteId';

    protected $fillable = ['nombre', 'telefono', 'tipo_cliente'];
}