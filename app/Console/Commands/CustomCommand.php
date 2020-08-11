<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use DB;
use mail;
use App\User;

class CustomCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'custom:command';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all inactive users';
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
    $arr_users = User::all();
       if(count($arr_users) > 0) {
       foreach ($arr_users as $user) {
                    $name = $user->name;
                    $email = $user->email;
                    $data = array("name" => $name, "body" => "This is our new promotional offer");
                    \Mail::send('emails.mail', $data, function($message) use ($name, $email) {
                        $message->to($email, $name)
                                ->subject('New Offer Launched');
                        $message->from('admin@artisansweb.net', 'Artisans Web');
                    });
   }
}
   $this->info('Minute Update has been send successfully');
   
}
}


