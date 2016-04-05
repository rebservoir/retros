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
use TuFracc\Sites_users_deleted;
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

        $id_site = \Session::get('id_site');
        $user = DB::table('users')->where('email', $email )->first();
        
        if(!empty($user)){  //si existe
            //activo en este sitio?
            $sites_users = Sites_users::where('id_user',$user->id)->where('id_site',$id_site)->count();

            if($sites_users>0){ //activo en sitio
                return response()->json([
                    "res"=> "2"
                ]);
            }else{ //no activo en sitio

                //esta en otro sitio?
                $site_user = Sites_users::where('id_user',$user->id)->count();
                
                if($site_user>0){ //activo en otro sitio
                    return response()->json([
                        "res"=> "3",
                        "id_user"=> $user->id
                    ]);
                }else{ //no activo en otro sitio

                    //fue eliminado de este sitio?
                    $site_user_del = Sites_users_deleted::where('id_user',$user->id)->where('id_site',$id_site)->count();

                    if($site_user_del>0){ //fue eliminado de este sitio
                        return response()->json([
                            "res"=> "5",
                            "id_user"=> $user->id
                        ]);
                    }else{ //fue eliminado de otro sitio
                        return response()->json([
                                "res"=> "4",
                                "id_user"=> $user->id
                            ]);
                    }
                }
            }  
        }else{  //no existe
            return response()->json([
                "res"=> "1"
            ]);
        }
        
    } 

    public function asignar($id){

        $id_site = \Session::get('id_site');
        $sitio = Sites::where('id', $id_site)->get();
        $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
        $user_limit = DB::table('plans')->where('id', $id_site )->value('user_limit');
        $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();

        if( $user_count<$user_limit){
            
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

    public function reactivar($id){

        $id_site = \Session::get('id_site');
        $sitio = Sites::where('id', $id_site)->get();
        $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
        $user_limit = DB::table('plans')->where('id', $id_site )->value('user_limit');
        $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();

        if( $user_count<$user_limit){

            $site_user_del = DB::table('sites_users_deleted')->where('id_user',$id)->where('id_site',$id_site);
            $site_user_del->delete();

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
        $id_site = \Session::get('id_site');
        $user = DB::select('select users.* FROM users INNER JOIN sites_users ON sites_users.id_user = users.id AND sites_users.id_site = :id', ['id' => $id_site]);
        return response()->json($user);
    }

    public function search($id)
    {
        $id_site = \Session::get('id_site');
        $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
        $plan = Plans::where('id', $sitio_plan )->get();
        $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();
        $tipos = Cuotas::orderBy('id', 'ASC')->lists('concepto','id');
        $users = User::where('id', $id)->get();
            return view('/admin/usuarios', [ 'users' => $users, 'tipos' => $tipos, 'user_count' => $user_count, 'plan'=>$plan]);
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
        $id_site = \Session::get('id_site');
        $sitio_plan = DB::table('sites')->where('id', $id_site )->value('plan');
        $plan = Plans::where('id', $sitio_plan )->get();
        $user_count = DB::table('sites_users')->where('id_site', $id_site)->count();
        $tipos = Cuotas::orderBy('id', 'ASC')->lists('concepto','id');
        $users =DB::select('select users.* FROM users INNER JOIN sites_users ON sites_users.id_user = users.id AND sites_users.id_site = :id', ['id' => $id_site]);
        $users = collect($users);

        if($sort == 'name'){
            $users = $users->sortBy('name');
        }else if($sort == 'desc'){
            $users = $users->sortByDesc('name');
        }else if($sort == 'email'){
            $users = $users->sortBy('email');
        }else if($sort == 'email_desc'){
            $users = $users->sortByDesc('email');
        }else if($sort == 'all'){
            $users = $users;
        }else if($sort == 'adeudo'){
            $users = $users->where('status', 0);
        }else if($sort == 'corriente'){
            $users = $users->where('status', 1);
        }
            return view('/admin/usuarios', ['users' => $users, 'tipos' => $tipos, 'user_count' => $user_count, 'plan'=>$plan]);
    }


    public function sort_usr($sort)
    {
        $id_site = \Session::get('id_site');
        
        if($sort == 1){ //all
            $users =DB::select('select users.* FROM users INNER JOIN sites_users ON sites_users.id_user = users.id AND sites_users.id_site = :id AND users.role = 0 order by users.name', ['id' => $id_site]);
            //$users = $users->sortBy('name');
        }else if($sort == 2){ //adeudo
            $users =DB::select('select users.* FROM users INNER JOIN sites_users ON sites_users.id_user = users.id AND sites_users.id_site = :id AND users.role = 0 AND users.status = 0 order by users.name', ['id' => $id_site]);
        }else if($sort == 3){ //corriente
            $users =DB::select('select users.* FROM users INNER JOIN sites_users ON sites_users.id_user = users.id AND sites_users.id_site = :id AND users.role = 0 AND users.status = 1 order by users.name', ['id' => $id_site]);
        }
            $users = collect($users);
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
        //$user = User::find($id);
        $site_user = DB::delete('delete from sites_users where id_site = ? and id_user = ?', [$id_site, $id]);
        DB::table('sites_users_deleted')->insert(['id_user' => $id,'id_site' => $id_site]);
        //$user->delete();


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
