<?php

namespace App\Console\Commands;

use App\Models\ModuleQuestion;
use App\Models\UserModuleAnswer;
use App\Models\User;
use App\Notifications\NotAllPreviousMonthsModulesCompleted;
use App\Notifications\notCompletedModule;
use Illuminate\Support\Facades\Notification;
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

        foreach(User::All() as $user)
        {
            // so, we've got the users details now, what we want to do is check which module they're on
            // and how many they've completed through this month.
            $modules = ModuleQuestion::where('module_id', $user->module)->get();

            // right, now we have to see if the user has complete those module questions.
            // if they have, progress their module, until the're at module 12, then we want to go back
            // to module 1.

            $count = 0;

            $date = Carbon::now();

            foreach($modules as $module)
            {
                // has user completed this module?
                $completedModules = UserModuleAnswer::
                where('module_question_id' , $module->id)
                    ->where('user_id', $user->id)
                    ->get();

                // now we need to get the modules that are under 6 months old, as we dont want
                // to pick up las years answers

                $today = carbon::now();

                foreach($completedModules as $module) {
                    $modulesDate = Carbon::createFromFormat('Y-m-d H:i:s', $module->updated_at);
                    // USER MODULE - HAS TO BE COMPLETED WITHIN 6 MONTHS!!
                    if ($today->diffInMonths($modulesDate) < 6) {
                        $count++;
                    }
                }
            }

            if($count < count($modules))
            {
                $tasksLeft = count($modules) - $count;

                Notification::send($user, new
                NotAllPreviousMonthsModulesCompleted(['user' => $user, 'count' => $tasksLeft]));

            }else{
                if($user->module < 12)
                {
                    $module = $user->module;
                    $module = $module + 1;
                    $user->module = $module;
                    $user->save();
                }else{
                    $user->module = 1;
                    $user->save();
                }
            }

            //dd($completed);

        }

    }
}
