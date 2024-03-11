<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailQueueDemo;
use Mail;
use Illuminate\Support\Facades\Log;
class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
     protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
      
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
            Log::info('SendEmailJob handling...');
    $info = $this->data;
    $email = new SendEmailQueueDemo($info);
    Mail::to($this->data['email'])->send($email);
    Log::info('SendEmailJob handled successfully.');
    }
}
