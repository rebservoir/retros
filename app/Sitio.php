<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Sitio extends Model
{
    protected $table = 'sitio';

    public $timestamps = false;

    protected $fillable = ['name', 'picture'];

    public function setPathAttribute($path){
    	$this->attributes['path'] = 'site_' . time() . '.' . $path->getClientOriginalName();
    	$name = 'site_' . time() . '.' . $path->getClientOriginalName();
    	\Storage::disk('local')->put($name, \File::get($path));
    }
}
