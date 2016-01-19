<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Cuotas extends Model
{
    protected $table = "cuotas";

    public $timestamps = false;

    protected $fillable = ['year','month','corte','vencimiento','cuota'];
}
