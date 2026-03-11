<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lamaran PKL Baru</title>
    <style>
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; line-height: 1.6; color: #1f2937; margin: 0; padding: 0; background-color: #f9fafb; }
        .container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb; }
        .header { background: linear-gradient(135deg, #2563eb, #1d4ed8); color: white; padding: 32px 24px; text-align: center; }
        .header h1 { margin: 0; font-size: 24px; font-weight: 700; letter-spacing: -0.025em; }
        .content { padding: 32px 24px; }
        .info-card { background-color: #f3f4f6; border-radius: 8px; padding: 20px; margin: 24px 0; border-left: 4px solid #2563eb; }
        .info-row { margin-bottom: 12px; display: flex; }
        .info-label { font-weight: 600; color: #4b5563; min-width: 100px; }
        .info-value { color: #111827; flex: 1; }
        .button { display: inline-block; background-color: #2563eb; color: white !important; padding: 14px 28px; border-radius: 8px; text-decoration: none; font-weight: 600; text-align: center; margin-top: 16px; transition: background-color 0.2s; }
        .footer { padding: 24px; text-align: center; font-size: 14px; color: #6b7280; background-color: #f9fafb; border-top: 1px solid #e5e7eb; }
        h2 { font-size: 18px; color: #111827; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Lamaran PKL Baru</h1>
        </div>
        <div class="content">
            <h2>Halo, {{ $notifiable->name }}!</h2>
            <p>Ada siswa baru yang tertarik untuk bergabung melalui lowongan PKL di perusahaan Anda.</p>
            
            <div class="info-card">
                <div class="info-row">
                    <span class="info-label">Siswa:</span>
                    <span class="info-value">{{ $lamaran->user->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $lamaran->user->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Lowongan:</span>
                    <span class="info-value">{{ $lamaran->posisi->lowongan->judul }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Posisi:</span>
                    <span class="info-value">{{ $lamaran->posisi->nama }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Sekolah:</span>
                    <span class="info-value">{{ $lamaran->sekolah->nama ?? '-' }}</span>
                </div>
            </div>

            <p>Segera tinjau lamaran ini untuk memberikan keputusan kepada siswa.</p>
            
            <div style="text-align: center;">
                <a href="{{ url('/dudi/lamaran') }}" class="button">Lihat Lamaran Lengkap</a>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Portal PKL. Seluruh hak cipta dilindungi.
        </div>
    </div>
</body>
</html>
