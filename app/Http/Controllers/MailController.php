<?php
namespace TuFracc\Http\Controllers;

require "vendor/autoload.php";

use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use Mail;
use Session;
use Redirect;
use TuFracc\Http\Controllers\Controller;

class MailController extends Controller
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
        /*
        Mail::send('emails.contact',$request->all(), function($msj){
            $msj->subject('Contacto');
            $msj->to('tufracc@gmail.com');
        });
        Session::flash('message','Mensaje enviado correctamente');
        return Redirect::to('/contacto');
        */
        Mail::send('emails.contact',$request->all(), function($msj){
            $msj->subject('Contacto');
            $msj->to('tufracc@gmail.com');
        });

        return response()->json([
            "message"=>'listo'
        ]);
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
        //
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
