<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pengambilan Sertifikat</title>
</head>
<body>
    <h2>Selamat Datang!</h2>
    <p>Terima kasih telah hadir di acara kali ini!!. Berikut adalah detail profil Anda:</p>
    <ul>
        <li><strong>Nama:</strong> {{ $userData['name'] }}</li>
        <li><strong>Email:</strong> {{ $userData['email'] }}</li>
        <li><strong>No WhatsApp:</strong> {{ $userData['no_wa'] }}</li>
    </ul>
    <p><strong>Silahkan Klik link dibawah ini untuk download sertifkat anda : </strong></p>
    <a href="{{ route('sertifikat', $userData['random_id']) }}">Download Sertifikat</a>

    <p>Terima kasih atas perhatian Anda. Semoga harimu menyenangkan!</p>
</body>
</html>
