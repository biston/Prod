<?php

namespace App\Console\Commands;

use App\Employe;
use Carbon\Carbon;
use App\Mail\HappyBirthDay;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendBirthMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail for notify the birth Day';

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
        $employe=Employe::find(4);
        Mail::to($employe->email)->send(new HappyBirthDay());

        $employe->historiques()->create([
            'employe_id'=>$employe->id,
            'status'=>'OK',
            'date_traitement'=>Carbon::now()
        ]);

    }
}
