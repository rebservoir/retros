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

            $id_user = $request->id_user;
            $user = User::find($id_user);
            $cuota = Cuotas::find($user->type);

            DB::table('pagos')->insert(
                ['id_user' => $id_user,
                 'date' => $request->date,
                 'status' => $request->status,
                 'amount' => $cuota->amount,
                 'user_name' => $user->name
                 ]
            );

        $data = [ 'msg'=> 'pago generado', 'subj'=> 'Pago acreditado', 'user_mail' => $user->email];

        Mail::send('emails.msg',$data, function ($msj) use ($data) {
            $msj->subject($data['subj']);
            $msj->to($data['user_mail']);
        });

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
    public function show(){

        $pagos_show = Pagos::where(function ($query) {
            $query->where('id_user', $id)
                ->where('status', 0)
                ->sortBy('date');
                  })->get();

        return response()->json(
            $pagos_show->toArray()
            );
    }

    public function detalle($id){

        $pagos = Pagos::where('id_user', $id)->orderBy('date', 'asc')->get();

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
