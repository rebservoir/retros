<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Controllers\Controller;
use TuFracc\Http\Requests\SitioUpdateRequest;
use TuFracc\Sitio;
use Session;
use Redirect;
use Illuminate\Routing\Route;

class SitioController extends Controller
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
    public function store(Request $request)
    {
        //
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
        $sitio = Sitio::find($id);

        return response()->json(
            $sitio->toArray()
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SitioUpdateRequest $request)
    { 

        $sitio = Sitio::find(1);
        $sitio->name = $request->name;

        if($request->hasFile('picture')){

            $oldFile = $sitio->picture;
            $file = $request->file('picture');
            $destination_path = public_path().'/file/';
            $name = 'sitio_' . time() . '.' . $file->getClientOriginalName();
            \Storage::disk('local')->put($name, \File::get($file));
            unlink($destination_path.$oldFile);
            $sitio->picture = $name;
        }

        $sitio->save();

        \Session::flash('success', 'Sitio actualizado exitosamente.');

        return redirect()->to('/admin/home'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
