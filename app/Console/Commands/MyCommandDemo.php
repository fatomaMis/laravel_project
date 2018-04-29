<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Client;
use Illuminate\Support\Facades\Mail;


class MyCommandDemo extends Command
{
   
    protected $signature = 'mycommand:demo';

    

    protected $description = 'Sending emails to the users.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $data = array(
            'name' => 'fatma',
            'msg'=> 'WE MISS YOU'
       );

       $clients = Client::all();
    foreach($clients as $client){
        Mail::send('emails.test', $data, function ($message) {

            $message->from('djangoteam2018@gmail.com');
            
            $message->to($client->email);

            // dd($client->email);
        });
    }
     
    }
}