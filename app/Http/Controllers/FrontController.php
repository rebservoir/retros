<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Controllers\Controller;
use TuFracc\User;
use TuFracc\Noticia;
use TuFracc\Morosos;
use TuFracc\Utiles;
use TuFracc\Pagos;
use TuFracc\Egresos;
use TuFracc\Saldos;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;
use Redirect;
use Illuminate\Database\Eloquent;

class FrontController extends Controller
{
    protected $auth;

    public function __construct(Guard $auth){
        $this->middleware('auth', ['only' => ['index', 'admin', 'contacto', 'noticias', 'cuenta', 
            'mifrac','admin_modulo','contenidos','calendario','transparencia', 'usuarios']]);
        $this->auth = $auth;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->auth->user()->role != 1){
            $morosos = Morosos::where('id', 0)->get();;
            $users = User::paginate(20);
            $noticias = Noticia::all()->sortByDesc('created_at')->take(2);
             return view('index', ['users' => $users, 'noticias' => $noticias, 'morosos' => $morosos ]);
        }else{
            return redirect()->to('/admin/home');
        }
    }

    public function login()
    {
        return view('login');
    }

    public function noticias(Request $request)
    {
        $noticias = Noticia::orderBy('created_at', 'desc')->paginate(5);
        $noticias->setPath('/noticias');

        if($this->auth->user()->role != 1){
            if($request->ajax()){
            return view('noticia.noticias', ['noticias' => $noticias]);
            }
            return view('noticias', ['noticias' => $noticias]);
        }else{
            return view('admin.noticias', ['noticias' => $noticias]);
        }
    }

    public function cuenta()
    {
        $pagos = Pagos::all();
        return view('cuenta', ['pagos' => $pagos]);
    }

    public function mifrac()
    {
        $utiles = Utiles::all();
        return view('mifrac/mifrac', ['utiles' => $utiles]);
    }

    public function transparencia()
    {
      

        $egresos = Egresos::all();
        $saldos = Saldos::all();
        return view('transparencia', [ 'egresos' => $egresos, 'saldos' => $saldos ]);
    }

    
    public function calendario()
    {
        return view('calendario');
    }

    public function contacto()
    {
        return view('contacto');
    }

    public function admin()
    {
        if($this->auth->user()->role == 1){

                $users = User::paginate(20);
                $users->setPath('/admin/home');
                $morosos = Morosos::where('id', 0)->get();
                $noticias = Noticia::all()->sortByDesc('created_at')->take(2);
                return view('admin/index', ['noticias' => $noticias, 'users' => $users, 'morosos' => $morosos ]);

        }else{
                 return Redirect::to('home');
        }
    }

    public function admin_modulo()
    {
        if($this->auth->user()->role == 1){
            $users = User::paginate(20);
            $users->setPath('/admin/administracion');
            $pagos = Pagos::all();
            $egresos = Egresos::all();
            return view('/admin/admin_modulo', ['users' => $users, 'pagos' => $pagos, 'egresos' => $egresos]);
        }else{
                 return Redirect::to('home');
        }
    }

    public function contenidos()
    {
        if($this->auth->user()->role == 1){
            $noticias = Noticia::all();
            $utiles = Utiles::all();
            $morosos = Morosos::all()->where('id', 0);
            return view('/admin/contenidos', [ 'morosos' => $morosos, 'utiles' => $utiles, 'noticias' => $noticias]);
        }else{
            return Redirect::to('home');
        }
    }

    public function usuarios()
    {
        if($this->auth->user()->role == 1){
            $users = User::all();
            return view('/admin/usuarios', [ 'users' => $users]);
        }else{
            return Redirect::to('home');
        }
    }


}
