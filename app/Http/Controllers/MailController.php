<?php

namespace TuFracc\Http\Controllers;

use TuFracc\User;
use Illuminate\Http\Request;
use TuFracc\Http\Requests;
use Mail;
use Session;
use Redirect;
use TuFracc\Http\Controllers\Controller;
use App\Jobs\SendEmail;

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

    public function contact(Request $request)
    {
        Mail::send('emails.contact',$request->all(), function($msj){
            $msj->subject('Contacto');
            $msj->to('tufracc@gmail.com');
        });

        return response()->json([
            "message"=>'listo'
        ]);
    }


    public function sendEmail(Request $request,$id)
    {
        $user = User::findOrFail($id);

        //Mail::later(5, 'emails.email', ['user' => $user], function ($msj) use ($user) {
        Mail::queue('emails.email', ['user' => $user], function ($msj) use ($user){   
            $msj->subject('Email');
            $msj->to($user->email);
        });

        return response()->json([
            "message"=>'listo'
        ]);
    }

    public function sendEmailMsg(Request $request,$id)
    {
        $user = User::findOrFail($id);

        $data = [ 'msg'=> $request->input('msg'), 'subj'=> $request->input('subj'), 'user_mail' => $user->email];

/*
        Mail::later(5, 'emails.msg', $data , function ($msj) use ($user) {
            $msj->subject('Email');
            $msj->to($user->email);
        });
*/
        Mail::send('emails.msg',$data, function ($msj) use ($data) {
            $msj->subject($data['subj']);
            $msj->to($data['user_mail']);
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
