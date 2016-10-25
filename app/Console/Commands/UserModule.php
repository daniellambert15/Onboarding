<?php

namespace App\Console\Commands;

use App\Models\ModuleQuestion;
use App\Models\User;
use Mail;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UserModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:userModule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will check if the user can proceed to the next module';

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
        // this is schedule is to see whether a user can proceed to the next module.

        $dt = new Carbon;

        foreach(User::All() as $user)
        {
            // so, we've got the users details now, what we want to do is check which module they're on
            // and how many they've completed through this month.

            $modules = ModuleQuestion::where('module_id', $user->module)->get();

            dd($modules);

        }

    }
}
