<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\UserCreateRequest;
use TuFracc\Http\Requests\UserUpdateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\User;
use TuFracc\Cuotas;
use TuFracc\Sites;
use TuFracc\Sites_users;
use TuFracc\Plans;
use Session;
use Redirect;
use Excel;
use DB;
use Illuminate\Routing\Route;
use Illuminate\Database\Eloquent;

class UsuarioController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
       // $this->beforeFilter('@find', ['only' => ['edit','update','destroy']]);
    }


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

        if($request->ajax()){

            $id_site = \Session::get('id_site');
            $sitio = Sites::where('id', $id_site)->get();
            $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
            //$plan = Plans::where('id', $sitio_plan )->get();
            $user_limit = DB::table('plans')->where('id', $id_site )->value('user_limit');
            $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();

            if( $user_count<$user_limit){

                $new_user = User::create($request->all());

                DB::table('sites_users')->insert(
                ['id_user' => $new_user->id,
                 'id_site' => $id_site
                 ]
                );
                /*    
                $data = [ 'msg'=> 'pago generado', 'subj'=> 'Pago acreditado', 'user_mail' => $user->email];

                Mail::send('emails.msg',$data, function ($msj) use ($data) {
                    $msj->subject($data['subj']);
                    $msj->to($data['user_mail']);
                });
                */

                return response()->json([
                    "tipo" => 'success',
                    "message"=> 'Usuario Creado Exitosamente.'
                ]);
            }else{
                return response()->json([
                    "tipo" => 'limite',
                    "message"=>'Limite alcanzado. No se pueden crear más usuarios.'
                ]);

            }     
        }

    }

    public function checkEmail($email){

        $user = DB::table('users')->where('email', $email )->first();

        if(!empty($user)){
            //el email ya esta registrado
            if($user->deleted_at == null){
                //Este mail ya esta registrado para un usuario activo.
                return response()->json([
                    "res"=> "1"
                ]);
            }else{
                //Un usuario con este email fue eliminado anteriormente.'
                return response()->json([
                    "res"=> "2",
                    "id_user"=> $user->id
                ]);
            }
        }else{
            return response()->json([
                "res"=> "3"
            ]);
        }

    } 

    public function reactivar($id){

        $id_site = \Session::get('id_site');
        $sitio = Sites::where('id', $id_site)->get();
        $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
        $user_limit = DB::table('plans')->where('id', $id_site )->value('user_limit');
        $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();

        if( $user_count<$user_limit){
            DB::table('users')->where('id', $id )->update(['deleted_at' => null]);
            DB::table('sites_users')->insert(
                    ['id_user' => $id,
                     'id_site' => $id_site
                     ]
            );
            return response()->json([
                "res" => 'ok'
            ]);
        }else{
            return response()->json([
                "res" => 'fail'
            ]);
        }

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
        $tipos = Cuotas::orderBy('id', 'ASC')->lists('concepto','id');
        $users = User::where('id', $id)->get();
            return view('/admin/usuarios', [ 'users' => $users, 'tipos' => $tipos]);
    }

    public function add($id)
    {
        $users = User::where('id', $id)->get();
            return response()->json(
                    $users->toArray()
                );
    }

    public function sort($sort)
    {
        $tipos = Cuotas::orderBy('id', 'ASC')->lists('concepto','id');

        if($sort == 'name'){
            $users = User::all()->sortBy('name');
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
            return view('/admin/usuarios', [ 'users' => $users, 'tipos' => $tipos ]);
    }


    public function sort_usr($sort)
    {
        if($sort == 1){ //all
            $users = User::where('role','!=',1)->orderBy('name', 'ASC')->get();
        }else if($sort == 2){ //adeudo
            $users = User::where('status', 1 )->get();
        }else if($sort == 3){ //corriente
            $users = User::where('status', 0 )->get();
        }
            return response()->json(
                $users->toArray()
            );
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
        $id_site = \Session::get('id_site');
        $user = User::find($id);
        $site_user = DB::delete('delete from sites_users where id_site = ? and id_user = ?', [$id_site, $id]);
        $user->delete();


        return response()->json([
            "mensaje"=> $site_user
            ]);
    }


    public function loadData(Request $request){
        /*
        Excel::load('file/file.xlsx', function($file)
        {
            $result=$file->get();
          
            foreach ($result as $key => $value)
            {
                echo $value->nombre.'--'.$value->email.'--'.$value->direccion.'<br>';
            }
        
        })->get();
        */

        if($request->hasFile('file')){
            $file = $request->file('file');
            $result = Excel::load($file)->get();
        }   

        //$result = Excel::load('file/file.xlsx')->get();
        /*
        return response()->json(
                $result->toArray()
            );
        */
        $users = User::all();
        $tipos = Cuotas::lists('concepto','id');
        return view('/admin/usuarios', [ 'users' => $users, 'tipos' => $tipos, 'result' => $result ]);

    }


}
