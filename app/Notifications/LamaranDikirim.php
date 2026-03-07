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
        $siswa = $this->lamaran->user;
        $posisi = $this->lamaran->posisi;
        $lowongan = $posisi->lowongan;

        return (new MailMessage)
            ->subject('Lamaran PKL Baru — ' . $siswa->name)
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Ada lamaran PKL baru yang masuk untuk lowongan Anda.')
            ->line('**Siswa:** ' . $siswa->name)
            ->line('**Email:** ' . $siswa->email)
            ->line('**Lowongan:** ' . $lowongan->judul)
            ->line('**Posisi:** ' . $posisi->nama)
            ->line('**Sekolah:** ' . ($this->lamaran->sekolah->nama ?? '-'))
            ->line('**Jurusan:** ' . ($this->lamaran->jurusan->nama ?? '-'))
            ->action('Lihat Lamaran', url('/dudi/lamaran'))
            ->line('Segera tinjau lamaran ini.');
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