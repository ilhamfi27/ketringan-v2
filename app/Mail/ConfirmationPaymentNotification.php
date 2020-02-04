<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmationPaymentNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data_bank;
    private $nama;
    private $kode_pesanan;
    private $total_biaya;

    public function __construct($payment)
    {
        $this->data_bank = $payment->data_bank;
        $this->nama = $payment->nama;
        $this->kode_pesanan = $payment->kode_pesanan;
        $this->total_biaya = $payment->total_biaya;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Konfirmasi Pembayaran Baru Ketringan Event')
                    ->view('email.payment.confirmation_payment_notification')
                    ->with([
                        'data_bank'     => $this->data_bank,
                        'nama'          => $this->nama,
                        'kode_pesanan'  => $this->kode_pesanan,
                        'total_biaya'   => $this->total_biaya,
                    ]);
    }
}
