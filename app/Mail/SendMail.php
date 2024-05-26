<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $company_name;
    public $post_name;
    /**
     * Create a new message instance.
     */
    // public function __construct()
    // {
    //     $this->subject = $subject;
    //     $this->company_name = $company_name;
    //     $this->post_name = $post_name;
    // }

    /**
     * Get the message envelope.
     */
    // public function build(Request $request){
    //     $user = auth('candidate')->user()->id;
    //     $name = auth('candidate')->user()->name;
    //     $seeker = SeekerProfile::where('candidate_id', $user)->where('is_active',1)->first();
    //     $company_name = $this->company_name;
    //     $post_name = $this->post_name;
    //     return $this->subject('BaKhoi')
    //                 ->view('email.email', compact('name','company_name','seeker','post_name'));
    // }
    //những cái có sẵn
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
