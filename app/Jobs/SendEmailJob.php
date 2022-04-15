<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmailJob //implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $event = $this->data;
		
        if(!isset($event['subject'])){
            $event['subject'] = '';
        }
        
        Mail::send('mail.'.$event['_blade'], $event, function($message) use ($event) {
            $message->to($event['email']);
            if(isset($event['cc']) && $event['cc'] !=''){
                $message->cc($event['cc']);    
            }
            $message->subject($event['subject']);
        });
    }
}
