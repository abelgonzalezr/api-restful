<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblarticulo extends Model
{
    protected $table = 'tblarticulos';

    protected $primaryKey = 'ArticuloId';

    protected $fillable = ['codigo_barras', 'descripcion', 'fabricante'];
}
