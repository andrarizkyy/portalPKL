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
        $perusahaan = $this->lamaran->posisi->lowongan->dudiProfile->nama_perusahaan ?? 'Perusahaan';

        return (new MailMessage)
            ->subject('Update Status Lamaran PKL — ' . $perusahaan)
            ->view('emails.application_status_updated', [
            'lamaran' => $this->lamaran,
            'notifiable' => $notifiable
        ]);
    }

    public function toArray(object $notifiable): array
    {
        $posisi = $this->lamaran->posisi;
        $perusahaan = $posisi->lowongan->dudiProfile->nama_perusahaan ?? 'Perusahaan';
        $status = $this->lamaran->status;

        return [
            'type' => 'lamaran_status',
            'message' => match ($status) {
                'approved' => 'Lamaran Anda di ' . $perusahaan . ' diterima!',
                'rejected' => 'Lamaran Anda di ' . $perusahaan . ' ditolak.',
                'cancelled' => 'Lamaran Anda di ' . $perusahaan . ' otomatis dibatalkan karena Anda sudah diterima di lowongan lain.',
                default => 'Status lamaran Anda di ' . $perusahaan . ' telah diperbarui.',
            },
            'lamaran_id' => $this->lamaran->id,
            'perusahaan' => $perusahaan,
            'posisi_nama' => $posisi->nama,
            'status' => $status,
        ];
    }
}