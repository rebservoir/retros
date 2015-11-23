<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Sitio extends Model
{
    protected $table = 'sitio';

    public $timestamps = false;

    protected $fillable = ['name', 'picture'];
}
