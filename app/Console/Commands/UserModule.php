<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Module;
use App\Models\ModuleQuestion;
use Illuminate\Console\Command;
use App\Models\UserModuleAnswer;
use App\Notifications\notCompletedModule;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotAllPreviousMonthsModulesCompleted;

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
            $questions = ModuleQuestion::where('module_id', $user->module)->get();

            // right, now we have to see if the user has complete those module questions.
            // if they have, progress their module, until the're at the last module, then we want to go back
            // to the first module.

            $count = 0;
			$number_questions = count($questions);

            $today = Carbon::now();

            foreach($questions as $question)
            {
                // has user completed this module?
                $answers = UserModuleAnswer::
                where('module_question_id' , $question->id)
                    ->where('user_id', $user->id)
                    ->get();

                // now we need to get the modules that are under 6 months old, as we dont want
                // to pick up last years answers

                foreach($answers as $answer) {
                    $answerDate = Carbon::createFromFormat('Y-m-d H:i:s', $answer->updated_at);

                    if ($today->diffInMonths($answerDate) < config('app.modules_months')) {
                        $count++;
                    }
                }
            }

            if($count < $number_questions)
            {
                $tasksLeft = $number_questions - $count;

                Notification::send($user, new
                NotAllPreviousMonthsModulesCompleted(['user' => $user, 'count' => $tasksLeft]));

            }else{

				$modules = Module::all();

                if($user->module < $modules->max('id'))
                {
                    $user->module = Module::where('id', '>', $user->module)->min('id');
                    $user->save();
                }else{
                    $user->module = $modules->first()->id;
                    $user->save();
                }
            }
        }
    }
}
