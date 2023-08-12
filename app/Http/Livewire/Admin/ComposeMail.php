<?php

namespace App\Http\Livewire\Admin;

use App\Jobs\SendEmailJob;
use App\Mail\SendMail;
use App\Mail\SendPublicMail;
use App\Models\Mail as ModelsMail;
use App\Models\User;
use App\Notifications\Admin\NewMailSentNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Foreach_;

class ComposeMail extends Component
{
    use WithFileUploads;

    public $add_email = [], $isManualEmailInput = false;
    public $to, $subject, $messageBody, $file;
    public $verifiedEmails = [];

    protected $listeners = ['addItem' => 'addEmail', 'addTo' => 'addReceiver'];

    public function addEmail($email)
    {
        array_push($this->add_email, $email);
    }

    public function addReceiver($to)
    {
        $this->to = $to;
    }

    public function sendMail()
    {
        $this->validate([
            'to' => 'required',
            'subject' => 'required|string|max:200',
        ]);

        $usersEmail = [];
        $manuallyInputedEmails = [];
        $file_attachments = [];
        $processData = [];

        try {

            if ($this->to == 'all') {
                $usersEmail = User::get(['email']);
            } elseif ($this->to == 'admin') {
                $usersEmail = User::admin()->get(['email']);
            } elseif ($this->to == 'writer') {
                $usersEmail = User::writer()->get(['email']);
            } elseif ($this->to == 'manualMail') {
                $this->verifyEmails();

                $manuallyInputedEmails = $this->verifiedEmails;
            }

            // dd($emails);

            // handle attachments
            if ($this->file) {

                foreach ($this->file as $file) {
                    $file_name = Str::random(10) . time() . '.' . $file->extension();

                    $filePath = $file->storeAs('shs/attachment', $file_name, 'real_public');
                    $file_attachments[] = public_path($filePath);
                }
            }

            // $data = [
            //     'subject' => $this->subject,
            //     'from' =>  auth()->user()->email,
            //     'body' => $this->messageBody,
            //     'attachment' => $file_attachments ? $file_attachments : [],
            // ];

            if ($manuallyInputedEmails || $usersEmail) {
                // foreach ($emails as $email) {

                    // try {
                    //     Mail::to($email)->send(new SendPublicMail($data));
                    // } catch (\Throwable $th) {
                    //     // Handle the exception here if needed
                    //     // If you want to skip sending to the current email and continue with the next one,
                    //     // you don't need to use 'continue' here because it will automatically continue with the next iteration
                    // }
                // }

                $attachments = json_encode($file_attachments);

                //  json_encode($manuallyInputedEmails)

                // $to = $this->to != 'manualMail' ? $this->to : ;

                $sentMailData = auth()->user()->mails()->create([
                    'to' =>  $this->to,
                    'from' =>  auth()->user()->email,
                    'subject' => $this->subject,
                    'body' => $this->messageBody,
                    'attachments' => $attachments,
                    'status' =>  false
                ]);

                if ($manuallyInputedEmails) {

                    foreach ($manuallyInputedEmails as $email) {
                        array_push($processData, [
                            'mail_id' => $sentMailData->id,
                            'email' => $email,
                            'status' => 0
                        ]);
                    }

                } elseif ($usersEmail) {

                    foreach ($usersEmail as $email) {
                        array_push($processData, [
                            'mail_id' => $sentMailData->id,
                            'email' => $email->email,
                            'status' => 0
                        ]);
                    }
                }

                DB::table('email_process')->insert($processData);
                SendEmailJob::dispatch();

                session()->flash('success', 'Mail sent successfully!');

                $admin = User::whereRole('ADM')->whereId('1')->first();
                $admin->notify(new NewMailSentNotification($sentMailData));

                return redirect()->route('admin.mail.send');
            } else {
                session()->flash('error', 'No email addresses available!');
                return redirect()->route('admin.mail.send');
            }
        } catch (\Throwable $th) {
            dd($th);
            session()->flash('error', 'Unable to send message!');
            return redirect()->route('admin.mail.send');
        }
    }

    public function verifyEmails()
    {
        $verifiedEmails = [];

        foreach ($this->add_email as $email) {
            $email = trim($email);

            // Use a more robust email validation pattern
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $verifiedEmails[] = $email;
            }
        }

        // Remove duplicates from the verified emails array
        $this->verifiedEmails = array_unique($verifiedEmails);
    }

    public function render()
    {
        return view('livewire.admin.compose-mail');
    }
}
