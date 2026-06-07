<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TaskAZU;
use App\Mail\TaskReminderMailableAZU;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

/**
 * Sends email reminders for tasks due tomorrow.
 *
 * This command is scheduled to run daily and notifies
 * task assignees or creators about upcoming deadlines.
 */

class SendTaskRemindersAZU extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:send-reminders-azu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders for tasks due tomorrow.';

    /**
     * Execute the console command.
     *
     * Finds tasks due tomorrow and sends reminder emails
     * to assigned users or task creators.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        // Get tasks due tomorrow that are not completed.//
        $tasks = TaskAZU::with(['assignee', 'creator'])
            ->whereDate('due_date', $tomorrow)
            ->where('status', '!=', 'completed')
            ->get();

        foreach ($tasks as $task) {
            // Send reminder to assigned user if exists.//
            if ($task->assignee) {
                Mail::to($task->assignee->email)->send(new TaskReminderMailableAZU($task));
                $this->info("Reminder sent for task: {$task->title} to {$task->assignee->email}");
                // Fallback: send reminder to task creator if no assignee exists.//
            } else if ($task->creator) {
                Mail::to($task->creator->email)->send(new TaskReminderMailableAZU($task));
                // Log command completion.//
                $this->info("Reminder sent for task: {$task->title} to {$task->creator->email}");
            }
        }

        $this->info('Task due date reminders sent successfully!');
    }
}
