<?php

namespace TuFracc;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Noticia extends Model
{
    protected $table = 'noticias';
    protected $fillable = ['titulo', 'texto', 'path'];

    public function setPathAttribute($path){
    	$this->attributes['path'] = 'tufracc_' . time() . '.' . $path->getClientOriginalName();
    	$name = Carbon::now()->second.$path->getClientOriginalName();
    	\Storage::disk('local')->put($name, \File::get($path));
    }

/*
    public static function Noticias(){
    	return DB::table('noticias')
    		//->join('genres','genres.id')
    }
*/
}

