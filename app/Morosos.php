<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Morosos extends Model
{
    protected $table = 'morosos';

    public $timestamps = false;

    protected $fillable = ['is_active'];
}
