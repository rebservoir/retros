<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Sites_user extends Model
{
    protected $table = 'sites_user';

    public $timestamps = false;

    protected $fillable = ['id_site', 'id_user'];

}
