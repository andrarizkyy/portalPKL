<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Lamaran PKL</title>
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
        }

        .header {
            padding: 32px 24px;
            text-align: center;
            color: white;
        }

        .header.approved {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .header.rejected {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.025em;
        }

        .content {
            padding: 32px 24px;
        }

        .info-card {
            background-color: #f3f4f6;
            border-radius: 8px;
            padding: 20px;
            margin: 24px 0;
        }

        .approved-border {
            border-left: 4px solid #10b981;
        }

        .rejected-border {
            border-left: 4px solid #ef4444;
        }

        .info-row {
            margin-bottom: 12px;
            display: flex;
        }

        .info-label {
            font-weight: 600;
            color: #4b5563;
            min-width: 120px;
        }

        .info-value {
            color: #111827;
            flex: 1;
        }

        .button {
            display: inline-block;
            color: white !important;
            padding: 14px 28px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            text-align: center;
            margin-top: 16px;
            transition: opacity 0.2s;
        }

        .button-approved {
            background-color: #10b981;
        }

        .button-rejected {
            background-color: #6b7280;
        }

        .footer {
            padding: 24px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            background-color: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }

        .celebration {
            font-size: 48px;
            display: block;
            margin-bottom: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        @if($lamaran->status === 'approved')
        <div class="header approved">
            <span class="celebration">🎉</span>
            <h1>Selamat! Lamaran Diterima</h1>
        </div>
        <div class="content">
            <h2>Halo, {{ $notifiable->name }}!</h2>
            <p>Kami memiliki kabar gembira untuk Anda. Lamaran PKL Anda telah kami tinjau dan hasilnya adalah
                <strong>DITERIMA</strong>.
            </p>

            <div class="info-card approved-border">
                <div class="info-row">
                    <span class="info-label">Perusahaan:</span>
                    <span class="info-value">{{ $lamaran->posisi->lowongan->dudiProfile->nama_perusahaan }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Lowongan:</span>
                    <span class="info-value">{{ $lamaran->posisi->lowongan->judul }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Posisi:</span>
                    <span class="info-value">{{ $lamaran->posisi->nama }}</span>
                </div>
            </div>

            <p>Silakan persiapkan diri Anda untuk memulai pengalaman PKL yang berharga. Klik tombol di bawah untuk
                melihat detail selengkapnya.</p>

            <div style="text-align: center;">
                <a href="{{ url('/siswa/lamaran') }}" class="button button-approved">Lihat Detail Lamaran</a>
            </div>
        </div>
        @elseif($lamaran->status === 'cancelled')
        <div class="header" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
            <h1>Lamaran Otomatis Dibatalkan</h1>
        </div>
        <div class="content">
            <h2>Halo, {{ $notifiable->name }}</h2>
            <p>Lamaran PKL Anda ke perusahaan berikut telah <strong>otomatis dibatalkan</strong> karena Anda sudah
                diterima di lowongan lain. Selamat!</p>

            <div class="info-card" style="border-left: 4px solid #f59e0b;">
                <div class="info-row">
                    <span class="info-label">Perusahaan:</span>
                    <span class="info-value">{{ $lamaran->posisi->lowongan->dudiProfile->nama_perusahaan }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Lowongan:</span>
                    <span class="info-value">{{ $lamaran->posisi->lowongan->judul }}</span>
                </div>
            </div>

            <p>Lamaran ini dibatalkan secara otomatis oleh sistem. Anda tidak perlu melakukan tindakan apa pun.</p>

            <div style="text-align: center;">
                <a href="{{ url('/siswa/lamaran') }}" class="button" style="background-color: #f59e0b;">Lihat Semua
                    Lamaran</a>
            </div>
        </div>
        @else
        <div class="header rejected">
            <h1>Update Status Lamaran</h1>
        </div>
        <div class="content">
            <h2>Halo, {{ $notifiable->name }}</h2>
            <p>Terima kasih telah melamar posisi PKL di platform kami. Setelah melalui proses peninjauan, saat ini kami
                memilih untuk <strong>tidak melanjutkan</strong> proses lamaran Anda.</p>

            <div class="info-card rejected-border">
                <div class="info-row">
                    <span class="info-label">Perusahaan:</span>
                    <span class="info-value">{{ $lamaran->posisi->lowongan->dudiProfile->nama_perusahaan }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Lowongan:</span>
                    <span class="info-value">{{ $lamaran->posisi->lowongan->judul }}</span>
                </div>
            </div>

            <p>Jangan berkecil hati! Masih banyak kesempatan PKL lainnya yang tersedia di platform kami. Tetap semangat
                dan coba lagi ya!</p>

            <div style="text-align: center;">
                <a href="{{ url('/siswa/lowongan') }}" class="button button-rejected">Cari Lowongan Lain</a>
            </div>
        </div>
        @endif
        <div class="footer">
            &copy; {{ date('Y') }} Portal PKL. Seluruh hak cipta dilindungi.
        </div>
    </div>
</body>

</html>