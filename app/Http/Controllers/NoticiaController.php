<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\NoticiaCreateRequest;
use TuFracc\Http\Requests\NoticiaUpdateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\Noticia;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Redirect;
use Illuminate\Routing\Route;

class NoticiaController extends Controller
{

    protected $auth;

    public function __construct(Guard $auth){
        $this->middleware('auth', ['only' => ['show']]);
    
        $this->auth = $auth;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noticia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(NoticiaCreateRequest $request)
    {
        if($request->ajax()){
            Noticia::create($request->all());
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

        $noti_show = Noticia::where('id', $id)->get();

        if($this->auth->user()->role == 1){
            return view('admin.noticia.show',['noti_show'=>$noti_show]);    
        }else{
            return Redirect::to('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noticia = Noticia::find($id);

        return response()->json(
            $noticia->toArray()
            );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $noticia = Noticia::find($id);
        $noticia->fill($request->all());
        $noticia->save();

        return response()->json([
            "mensaje"=>'update done'
            ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticia::find($id);
        $noticia->delete();

        return response()->json([
            "mensaje"=>'eliminado'
        ]);

    }
}
