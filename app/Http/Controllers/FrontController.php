<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\UserCreateRequest;
use TuFracc\Http\Requests\UserUpdateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\User;
use TuFracc\Noticia;
use TuFracc\Sections;
use TuFracc\Utiles;
use TuFracc\Pagos;
use TuFracc\Egresos;
use TuFracc\Saldos;
use TuFracc\Cuotas;
use TuFracc\Sites;
use TuFracc\Sites_users;
use TuFracc\Plans;
use TuFracc\Calendario;
use TuFracc\Documentos;
use DB;
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
            'sitio','admin_modulo','contenidos','calendario','finanzas', 'usuarios']]);
    
        $this->auth = $auth;

        if(!\Session::has('pagos_id')) \Session::put('pagos_id', array());
        if(!\Session::has('pagos_data')) \Session::put('pagos_data', array());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function CheckSite(){

        $id_user = $this->auth->user()->id;



    }

    public function index()
    {

        $id_site = 1;
        \Session::put('id_site', $id_site );

        if($this->auth->user()->role != 1){
            $sections = Sections::all();
            $users = User::paginate(10);
            $noticias = Noticia::all()->sortByDesc('created_at')->take(2);
            $sitios = Sites::where('id', 1)->get();
            return view('index', ['users' => $users, 'noticias' => $noticias, 'sections' => $sections, 'sitios' => $sitios ]);
        }else{
            return redirect()->to('/admin/home');
        }
    }

    public function login()
    {
        return view('login');
    }

    public function forgot()
    {
        return view('forgot');
    }

    public function noticias(Request $request)
    {
        $sections = Sections::all();
        $noticias = Noticia::orderBy('created_at', 'desc')->paginate(5);

        if($this->auth->user()->role != 1){
            $noticias->setPath('/noticias');
            if($request->ajax()){
            return view('noticia.noticias', ['noticias' => $noticias, 'sections' => $sections]);
            }
            return view('noticias', ['noticias' => $noticias, 'sections' => $sections]);
        }else{
            $noticias->setPath('/admin/noticias');
            return view('admin.noticias', ['noticias' => $noticias, 'sections' => $sections]);
        }
    }

    public function cuenta()
    {
        $sections = Sections::all();
        $pagos = Pagos::where(function ($query) {
                $query->where('id_user', $this->auth->user()->id)
                ->orderBy('date', 'asc');
                  })->get();
        $ultimo_p = DB::table('pagos')->where('id_user', $this->auth->user()->id)->where('status', 1)->orderBy('date', 'dsc')->get();
        $vencidos = DB::table('pagos')->where('id_user', $this->auth->user()->id)->where('status', 0)->orderBy('date', 'asc')->get();
        $cuotas = Cuotas::find($this->auth->user()->type);
        $cuota = $cuotas->amount;
        return view('cuenta', ['vencidos' => $vencidos,'pagos' => $pagos, 'cuotas' => $cuotas,
                                'sections' => $sections, 'ultimo_p' => $ultimo_p, 'cuota' => $cuota]);
    }

    public function miSitio()
    {
        $utiles = Utiles::all();
        $sections = Sections::all();
        $documentos = Documentos::all();
        return view('sitio/misitio', ['utiles' => $utiles, 'sections' => $sections, 'documentos' => $documentos]);
    }

    public function finanzas($mes_sel=null, $year_sel=null)
    {   
        if(!$mes_sel)
            $mes_sel = date('n');
        if(!$year_sel)
            $year_sel= date('Y');

        $pagos = Pagos::all(); 
        $egresos = Egresos::all();
        $saldos = Saldos::all();

        if($this->auth->user()->role == 1){
            return view('admin/finanzas', [ 'pagos' => $pagos,'egresos' => $egresos, 'saldos' => $saldos, 'mes_sel' => $mes_sel, 'year_sel' => $year_sel ]);
        }else{
            return view('finanzas', [ 'pagos' => $pagos,'egresos' => $egresos, 'saldos' => $saldos, 'mes_sel' => $mes_sel, 'year_sel' => $year_sel ]);     
        }  
    }

    
    public function calendario($mes_sel=null, $year_sel=null)
    {   
        if(!$mes_sel)
            $mes_sel = date('n');
        if(!$year_sel)
            $year_sel= date('Y');

        $sections = Sections::all();
        $calendario = Calendario::all();

        if($this->auth->user()->role == 1){
            return view('admin/calendario', [ 'mes_sel' => $mes_sel, 'year_sel' => $year_sel, 'sections' => $sections, 'calendario' => $calendario ]);
        }else{
            return view('calendario', [ 'mes_sel' => $mes_sel, 'year_sel' => $year_sel, 'sections' => $sections, 'calendario' => $calendario ]);     
        }  
    }


    public function contacto()
    {
        $sections = Sections::all();
        return view('contacto', ['sections' => $sections ]);
    }

    public function admin()
    {
        if($this->auth->user()->role == 1){
                $users = User::paginate(10);
                $users->setPath('/admin/home');
                $id_site = \Session::get('id_site');
                $sitios = Sites::where('id', $id_site)->get();
                $sections = Sections::all();
                $noticias = Noticia::all()->sortByDesc('created_at')->take(2);
                return view('admin/index', ['noticias' => $noticias, 'users' => $users, 'sections' => $sections, 'sitios' => $sitios ]);
        }else{
                 return Redirect::to('home');
        }
    }

    public function admin_modulo()
    {
        if($this->auth->user()->role == 1){

            $id_site = \Session::get('id_site');
            $sitio = Sites::where('id', $id_site)->get();
            $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
            $plan = Plans::where('id', $sitio_plan )->get();
            $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();
            
            $users = User::paginate(20);
            $users->setPath('/admin/administracion');
            $pagos = Pagos::all();
            $egresos = Egresos::all();
            $saldos = Saldos::all();
            $cuotas = Cuotas::orderBy('concepto', 'ASC')->get();

            return view('/admin/admin_modulo', ['users' => $users, 'pagos' => $pagos, 'egresos' => $egresos, 'cuotas' => $cuotas,
                'saldos' => $saldos, 'sitio' => $sitio, 'plan' => $plan, 'id_site' => $id_site, 'user_count'=>$user_count ]);
        }else{
                 return Redirect::to('home');
        }
    }

    public function contenidos()
    {
        if($this->auth->user()->role == 1){
            $noticias = Noticia::all();
            $documentos = Documentos::all();
            $utiles = Utiles::all();
            $sections = Sections::all();
            return view('/admin/contenidos', [ 'sections' => $sections, 'utiles' => $utiles, 
                'noticias' => $noticias, 'documentos' => $documentos ]);
        }else{
            return Redirect::to('home');
        }
    }

    public function usuarios()
    {
        if($this->auth->user()->role == 1){

                $id_site = \Session::get('id_site');
                $sitio = Sites::where('id', $id_site)->get();
                $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
                $plan = Plans::where('id', $sitio_plan )->get();
                $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();

                $users = User::all();
                //$users = User::paginate(5);
                //$users->setPath('/admin/usuarios');
                $tipos = Cuotas::lists('concepto','id');

            return view('/admin/usuarios', [ 'users' => $users, 'tipos' => $tipos, 'user_count' => $user_count, 'plan'=>$plan ]);
        }else{
            return Redirect::to('home');
        }
    }

    public function usuarios2($id)
    {
        if($this->auth->user()->role == 1){
                $users = User::all()->where('id', $id);
            return view('/admin/usuarios', [ 'users' => $users]);
        }else{
            return Redirect::to('home');
        }
    }

    public function edit_info($id)
    {
        $user = User::find($id);

        return response()->json(
            $user->toArray()
            );
    }

    public function pagos_show()
    {
        $pagos_show = Pagos::where(function ($query) {
                $query->where('id_user', $this->auth->user()->id)
                ->where('status', 0);
                  })->get();

        return response()->json(
            $pagos_show->toArray()
            );
    }

    public function update_info_user($id, UserUpdateRequest $request)
    {
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

            return response()->json([
                "message"=>'listo'
            ]);
    }


    

} // end
