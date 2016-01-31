<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Egresos extends Model
{
	protected $table = 'egresos';

    protected $fillable = ['concept','path','date','amount'];

    public function setPathAttribute($path){
		$this->attributes['path'] = 'tufracc_' . time() . '.' . $path->getClientOriginalName();
    	$name = Carbon::now()->second.$path->getClientOriginalName();
    	\Storage::disk('local')->put($name, \File::get($path));
    }

    

}
