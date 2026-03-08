<?php

namespace App\Notifications;

use App\Models\PendaftaranPkl;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue; // Pastikan ini di-import

class LamaranStatusUpdated extends Notification implements ShouldQueue
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
        $posisi = $this->lamaran->posisi;
        $lowongan = $posisi->lowongan;
        $perusahaan = $lowongan->dudiProfile->nama_perusahaan ?? 'Perusahaan';
        $status = $this->lamaran->status;

        $mail = (new MailMessage)
            ->subject('Update Status Lamaran PKL — ' . $perusahaan);

        if ($status === 'approved') {
            $mail->greeting('Selamat, ' . $notifiable->name . '! 🎉')
                ->line('Lamaran PKL Anda telah **DITERIMA**!')
                ->line('**Perusahaan:** ' . $perusahaan)
                ->line('**Lowongan:** ' . $lowongan->judul)
                ->line('**Posisi:** ' . $posisi->nama)
                ->line('Silakan persiapkan diri Anda untuk memulai PKL.')
                ->action('Lihat Detail Lamaran', url('/siswa/lamaran'));
        }
        else {
            $mail->greeting('Halo, ' . $notifiable->name)
                ->line('Mohon maaf, lamaran PKL Anda **ditolak**.')
                ->line('**Perusahaan:** ' . $perusahaan)
                ->line('**Lowongan:** ' . $lowongan->judul)
                ->line('**Posisi:** ' . $posisi->nama)
                ->line('Jangan berkecil hati! Masih banyak lowongan PKL lainnya yang bisa Anda coba.')
                ->action('Cari Lowongan Lain', url('/siswa/lowongan'));
        }

        return $mail;
    }

    public function toArray(object $notifiable): array
    {
        $posisi = $this->lamaran->posisi;
        $perusahaan = $posisi->lowongan->dudiProfile->nama_perusahaan ?? 'Perusahaan';
        $status = $this->lamaran->status;

        return [
            'type' => 'lamaran_status',
            'message' => $status === 'approved'
            ? 'Lamaran Anda di ' . $perusahaan . ' diterima!'
            : 'Lamaran Anda di ' . $perusahaan . ' ditolak.',
            'lamaran_id' => $this->lamaran->id,
            'perusahaan' => $perusahaan,
            'posisi_nama' => $posisi->nama,
            'status' => $status,
        ];
    }
}