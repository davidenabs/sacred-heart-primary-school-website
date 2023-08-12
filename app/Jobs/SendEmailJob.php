<?php

namespace App\Jobs;

use App\Mail\SendPublicMail;
use App\Models\Mail as ModelsMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $getSentEmails = DB::table('email_process')->where('status', 0)->get();
        info('Queue Started!!!');


        foreach ($getSentEmails as $data) {

            $getMail = ModelsMail::whereId($data->mail_id)->first();

            $mailData = [
                'subject' => $getMail->subject,
                'body' => $getMail->messageBody,
                'attachment' => $getMail->attachment,
            ];

            try {
                Mail::to($data->email)->send(new SendPublicMail($mailData));
                DB::table('email_process')->where('id', $data->id)->update(['status' => 1, 'send_time' =>strtotime('now')]);

            } catch (\Throwable $th) {
                DB::table('email_process')->where('id', $data->id)->update(['status' => 2, 'send_time' => strtotime('now')]);

                // echo 'hi';
                // Handle the exception here if needed
                // If you want to skip sending to the current email and continue with the next one,
                // you don't need to use 'continue' here because it will automatically continue with the next iteration
            }
        }
    }
}
