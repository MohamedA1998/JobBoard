<?php

namespace App\Console\Commands;

use App\Models\Job;
use App\Models\Newsletter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendNewsLetter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sendNewsLetter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send News Letter In Users Subscribe';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $members = Newsletter::all();

        $jobsCount = Job::NewsLetter()->count();

        $this->info("Found {$jobsCount} " . Str::plural('Job' , $jobsCount));

        $members->each(fn ($member) =>
            Mail::to($member->email)
                    ->send(new \App\Mail\NewsLetter(Job::NewsLetter()->get()))
        );

        $this->info('Reminder Mial Was Sended...');
    }
}
