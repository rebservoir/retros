<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\UserCreateRequest;
use TuFracc\Http\Requests\UserUpdateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\User;
use Session;
use Redirect;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent;

class UsuarioController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
       // $this->beforeFilter('@find', ['only' => ['edit','update','destroy']]);
    }

/*
    public function find(Route $route){
        $this->user User::find($route->getParameter('usuario'));
    }
*/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        $users->setPath('/laravel5_1/public/usuario');
        return view('usuario.usuarios',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        User::create($request->all());
        return response()->json([
            "message"=>'listo'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user = User::all();
        return response()->json(
            $user->toArray()
            );
    }

    public function search($id)
    {
        $users = User::where('id', $id)->get();
            return view('/admin/usuarios', [ 'users' => $users]);
    }

    public function sort($sort)
    {
        if($sort == 'name'){
            $users = User::all()->sortBy('name');
            $sel1 = 'name';
        }else if($sort == 'desc'){
            $users = User::all()->sortByDesc('name');
        }else if($sort == 'email'){
            $users = User::all()->sortBy('email');
        }else if($sort == 'email_desc'){
            $users = User::all()->sortByDesc('email');
        }else if($sort == 'all'){
            $users = User::all();
        }else if($sort == 'adeudo'){
            $users = User::where('status', 1 )->get();
        }else if($sort == 'corriente'){
            $users = User::where('status', 0 )->get();
        }
            return view('/admin/usuarios', [ 'users' => $users]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return response()->json(
            $user->toArray()
            );
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UserUpdateRequest $request)
    {
        
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

        return response()->json([
            "message"=>'listo'
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
        $user = User::find($id);
        $user->delete();

        return response()->json([
            "mensaje"=>'eliminado'
            ]);
    }
}
