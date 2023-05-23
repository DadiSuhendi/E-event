<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Konfirmasi Pendaftaran</title>
</head>
<body>
    <h2>Selamat Datang!</h2>
    <p>Terima kasih telah mendaftar. Berikut adalah detail pendaftaran Anda:</p>
    
    <ul>
        <li><strong>Nama:</strong> {{ $userData['name'] }}</li>
        <li><strong>Email:</strong> {{ $userData['email'] }}</li>
        <li><strong>No WhatsApp:</strong> {{ $userData['no_wa'] }}</li>
    </ul>

    <p>Silakan mengisi daftar hadir, setelah acara dimulai dengan klik tombol di bawah ini:</p>
    <a href="{{ env('APP_URL') }}">Isi daftar hadir</a>

    <p>Terima kasih atas perhatian Anda. Semoga harimu menyenangkan!</p>
</body>
</html>
