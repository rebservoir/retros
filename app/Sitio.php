<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;

class Sitio extends Model
{
    protected $table = 'sitio';

    public $timestamps = false;

    protected $fillable = ['name', 'picture'];

    public function setPathAttribute($path){
    	$this->attributes['path'] = 'tufracc_' . time() . '.' . $path->getClientOriginalName();
    	$name = Carbon::now()->second.$path->getClientOriginalName();
    	\Storage::disk('local')->put($name, \File::get($path));
    }
}
