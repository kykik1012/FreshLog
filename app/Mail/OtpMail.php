<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    // 1. WAJIB: Definisikan variable sebagai public
    public $otp;

    /**
     * Create a new message instance.
     */
    public function __construct($otp)
    {
        // 2. WAJIB: Masukkan data dari controller ke variable public ini
        $this->otp = $otp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode Verifikasi OTP Anda', // Judul Email
        );
    }

    /**
     * Get the message content definition.
     */
   public function content(): Content
{
    return new Content(
        // Pastikan file blade kamu namanya BENAR-BENAR 'OTP.blade.php' 
        // dan letaknya langsung di dalam folder 'resources/views/'
        view: 'OTP', 
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