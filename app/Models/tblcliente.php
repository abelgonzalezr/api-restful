<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblcliente extends Model
{
    protected $table = 'tblclientes';

    protected $primaryKey = 'ClienteId';

    protected $fillable = ['nombre', 'telefono', 'tipo_cliente'];

}
