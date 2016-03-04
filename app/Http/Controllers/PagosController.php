<?php

namespace TuFracc\Http\Controllers;

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use TuFracc\Http\Requests\PagoCreateRequest;
use TuFracc\Http\Requests\PagoUpdateRequest;
use TuFracc\Http\Controllers\Controller;
use TuFracc\Pagos;
use Illuminate\Contracts\Auth\Guard;
use Session;
use Redirect;
use Illuminate\Routing\Route;

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
    public function store(PagoCreateRequest $request)
    {
        if($request->ajax()){
            Pagos::create($request->all());
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
    public function show()
    {
        $pagos_show = Pagos::where(function ($query) {
                $query->where('id_user', $id)
                ->where('status', 0)
                ->sortBy('date');
                  })->get();

        return response()->json(
            $pagos_show->toArray()
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
