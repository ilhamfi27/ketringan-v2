<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MakePayment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $data_menu;
    private $syarat;
    private $link;
    private $data_bank;
    private $nama;
    private $kode_pesanan;
    private $kode_unik;
    private $alamat;
    private $tanggal;
    private $waktu;
    private $total_biaya;
    private $potongan;

    public function __construct($payment)
    {
        $this->data_menu = $payment->data_menu;
        $this->syarat = $payment->syarat;
        $this->link = $payment->link;
        $this->data_bank = $payment->data_bank;
        $this->nama = $payment->nama;
        $this->kode_pesanan = $payment->kode_pesanan;
        $this->kode_unik = $payment->kode_unik;
        $this->alamat = $payment->alamat;
        $this->tanggal = $payment->tanggal;
        $this->waktu = $payment->waktu;
        $this->total_biaya = $payment->total_biaya;
        $this->potongan = $payment->potongan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Detail Pesanan Ketringan Event')
                    ->view('email.payment.details')
                    ->with([
                        'data_menu'     => $this->data_menu,
                        'syarat'        => $this->syarat,
                        'link'          => $this->link,
                        'data_bank'     => $this->data_bank,
                        'nama'          => $this->nama,
                        'kode_pesanan'  => $this->kode_pesanan,
                        'kode_unik'     => $this->kode_unik,
                        'alamat'        => $this->alamat,
                        'tanggal'       => $this->tanggal,
                        'waktu'         => $this->waktu,
                        'total_biaya'   => $this->total_biaya,
                        'potongan'      => $this->potongan,
                    ]);
    }
}
