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
        $this->token = $user->token;
        $this->id = $user->id;
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
                    ->from('staging@ketringan.com')
                    ->view('email.auth.register_confirmation')
                    ->with([
                        'nama' => $this->nama,
                        'token' => $this->token,
                        'id' => $this->id,
                        'url' => $this->url,
                    ]);
    }
}
