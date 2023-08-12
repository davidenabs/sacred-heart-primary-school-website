<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendPublicMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected $mail,
    ) { }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mail['subject'],
            replyTo: [
                new Address(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')),
            ],

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {

        // dd($this->mail);
        return new Content(
            markdown: 'emails.send-public-mail',
            with: [
                'body' => $this->mail['body'],
            ]
            // html: $this->mail['body'],
            // text: strip_tags($this->mail['body']),
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];
        if ($this->mail['attachment']) {
            foreach ($this->mail['attachment'] as $key => $path) {
                // Get the filename part from the path
                $filename = pathinfo($path, PATHINFO_BASENAME);

                $attachment = Attachment::fromPath($path)
                    ->as($filename)  // Use the extracted filename
                    ->withMime(mime_content_type($path)); // You can use mime_content_type to get MIME type

                $attachments[] = $attachment;
            }
        }
        return $attachments;
    }
}
