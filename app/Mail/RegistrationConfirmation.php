<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    private $id;
    private $url;
    private $nama;
    private $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->nama = $user->nama;
        $this->url = $user->url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Konfirmasi Akun Pelanggan Ketringan")
                    ->view('email.auth.register_confirmation')
                    ->with([
                        'nama' => $this->nama,
                        'url' => $this->url,
                    ]);
    }
}
