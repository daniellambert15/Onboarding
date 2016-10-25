<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;

class testTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:testTask';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test sending emails';

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
        Mail::raw('Text to e-mail', function($message)
        {
            $message->from('test@onboarding.fcacomplianceservices.com', 'testing user');

            $message->to('daniel.lambert@gas-elec.co.uk');
        });
    }
}
