<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\EgresosCreateRequest;
use TuFracc\Http\Requests\EgresosUpdateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\Egresos;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Redirect;
use File;
use Illuminate\Routing\Route;

class EgresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EgresosCreateRequest $request)
    {
        if($request->ajax()){
            Egresos::create($request->all());
            return response()->json([
                    "message" => "creado"
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $egresos = Egresos::find($id);

        return response()->json(
            $egresos->toArray()
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EgresosCreateRequest $request, $id)
    {
            $id = $request->id_egresos;
            $egreso = Egresos::find($id);
            $egreso->concept = $request->concept;
            $egreso->date    = $request->date;
            $egreso->amount  = $request->amount;

            if($request->hasFile('path')){
                $oldFile = $egreso->path;
                $file = $request->file('path');
                $destinationPath = 'file/';
                //$file = 'noticia_' . time() . '.' . $file->getClientOriginalName();
                //\Storage::disk('local')->put($name, \File::get($file));
                if(File::isFile($oldFile)){
                    //File::delete($old_image);
                    unlink($destinationPath.$oldFile);
                }

                
                $egreso->path = $file;
            }

            $egreso->save();

            \Session::flash('update', 'Egreso actualizado exitosamente.');
        
            return redirect()->to('/admin/administracion'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $egresos = Egresos::find($id);
        $egresos->delete();
        \Storage::delete($egresos->path);

        return response()->json([
            "mensaje"=>'eliminado'
            ]);
    }
}
