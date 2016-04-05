<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\PagoCreateRequest;
use TuFracc\Http\Requests\PagoUpdateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\Pagos;
use TuFracc\Cuotas;
use TuFracc\User;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Redirect;
use Illuminate\Routing\Route;
use DB;
use Mail;
use App\Jobs\SendEmail;

class PagosController extends Controller
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
    public function store(PagoUpdateRequest $request)
    {
        if($request->ajax()){

            $id_site = \Session::get('id_site');
            $id_user = $request->id_user;
            $user = User::find($id_user);
            $cuota = Cuotas::find($user->type);
            $pagos = DB::table('pagos')->where('id_user', $id_user)->where('id_site', $id_site)->get();
            $newDate = explode("-", $request->date);
            $flag=true;

            foreach($pagos as $value){
                $date = explode("-", $value->date);
                if(($date[0]==$newDate[0])&&($date[1]==$newDate[1])){
                    $flag=false;
                    break;
                }
            }

            if($flag){

                $ultimo = DB::table('pagos')->where('id_user', $id_user)->orderBy('date', 'dsc')->take(1)->value('date');

                //get next year and month
                $ultimo_pago = explode("-", $ultimo);
                    if(intval($ultimo_pago[1])==12){
                        $next_m = 1;
                        $next_y = intval($ultimo_pago[0])+1;
                    }else{
                        $next_m = intval($ultimo_pago[1])+1;
                        $next_y = intval($ultimo_pago[0]);
                    }

                    if((intval($newDate[0])==$next_y)&&(intval($newDate[1])==$next_m)){
                        DB::table('pagos')->insert(
                        [   'id_user' => $id_user,
                            'date' => $request->date,
                            'status' => $request->status,
                            'amount' => $cuota->amount,
                            'user_name' => $user->name,
                            'id_site' => $id_site
                        ]);

                        $data = [ 'msg'=> 'pago generado', 'subj'=> 'Pago acreditado', 'user_mail' => $user->email];

                        Mail::send('emails.msg',$data, function ($msj) use ($data) {
                            $msj->subject($data['subj']);
                            $msj->to($data['user_mail']);
                        });

                        return response()->json([
                            "tipo" => 'success'
                        ]);
                    }else{
                        return response()->json([
                            "tipo" => 'fail',
                            "message" => 'No estan permitido intervalos sin pagos creados. Se debe crear un pago con fecha inmediata al ultimo creado.'
                        ]);
                    }

                }else{
                    return response()->json([
                        "tipo" => 'fail',
                        "message" => 'Ya existe un pago para este mes y usuario.'
                    ]);
                }
                
        } // end request ajax
    } //end function

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(){

        $id_site = \Session::get('id_site');
        $pagos_show = Pagos::where(function ($query) {
            $query->where('id_user', $id)
                ->where('status', 0)
                ->where('id_site', $id_site)
                ->sortBy('date');
                  })->get();

        return response()->json(
            $pagos_show->toArray()
            );
    }

    public function detalle($id){

        $id_site = \Session::get('id_site');
        $pagos = Pagos::where('id_user', $id)->where('id_site', $id_site)->orderBy('date', 'asc')->get();

        return response()->json(
            $pagos->toArray()
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
        $pago = Pagos::find($id);

        return response()->json(
            $pago->toArray()
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PagoUpdateRequest $request, $id)
    {
        $pago = Pagos::find($id);
        $pago->fill($request->all());
        $pago->save();

        \Session::flash('update', 'Pago actualizado exitosamente.');

        return response()->json([
            "mensaje"=>'listo'
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
        $pago = Pagos::find($id);
        $pago->delete();

        return response()->json([
            "mensaje"=>'eliminado'
            ]);
    }
}
