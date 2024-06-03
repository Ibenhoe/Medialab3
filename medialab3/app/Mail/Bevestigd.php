<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Bevestigd extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $item;
    public $product;
    public $reservation;

    public function __construct($user, $item, $product, $reservation)
    {
        $this->user = $user;
        $this->item = $item;
        $this->product = $product;
        $this->reservation = $reservation;
    }

    public function build()
    {       
        return $this->view('mail.bevestigd')
            ->with([
                'user' => $this->user,
                'items' => $this->item,
                'product' => $this->product,
                'reservation' => $this->reservation,
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Uw uitleenaanvraag is bevestigd',
        );
    }
    
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.bevestigd',
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
