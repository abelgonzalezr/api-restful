<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblPY1 extends Model
{
    protected $table = 'tblPY1';

    protected $primaryKey = 'UserId';

    protected $fillable = ['username', 'password', 'cedula', 'telefono', 'tipo_sangre'];
}
