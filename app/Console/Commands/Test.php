<?php

namespace TuFracc\Console\Commands;

use Illuminate\Console\Command;

use DB;
use TuFracc\Pagos;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tst:prueba';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a test';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        //DB::table('pagos')->insert(['id_user' => 666 , 'status' => 0, 'amount' => 550 , 'user_name' => 'xxx xxx']);

        $users = DB::table('users')->where('role', 0 )->where('deleted_at', null)->get();
        
            foreach ($users as $user) {
                DB::table('pagos')->insert(['id_user' => $user->id ,'date' => date("Y-d-m"), 'status' => 0, 'amount' => 500 , 'user_name' => $user->name ]);
            }



    }
}
