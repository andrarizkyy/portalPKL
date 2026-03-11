<?php

namespace App\Notifications;

use App\Models\PendaftaranPkl;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LamaranDikirim extends Notification
{
    use Queueable;

    public PendaftaranPkl $lamaran;

    public function __construct(PendaftaranPkl $lamaran)
    {
        $this->lamaran = $lamaran;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Lamaran PKL Baru — ' . $this->lamaran->user->name)
            ->view('emails.application_submitted', [
            'lamaran' => $this->lamaran,
            'notifiable' => $notifiable
        ]);
    }

    public function toArray(object $notifiable): array
    {
        $siswa = $this->lamaran->user;
        $posisi = $this->lamaran->posisi;

        return [
            'type' => 'lamaran_baru',
            'message' => $siswa->name . ' melamar posisi ' . $posisi->nama,
            'lamaran_id' => $this->lamaran->id,
            'siswa_name' => $siswa->name,
            'posisi_nama' => $posisi->nama,
        ];
    }
}