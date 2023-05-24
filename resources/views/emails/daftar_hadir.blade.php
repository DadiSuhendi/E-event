<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Hadir</title>
</head>
<body>
    <h2>Selamat Datang!</h2>
    <p>Terima kasih telah hadir di acara kali ini!!. Berikut adalah detail profil Anda:</p>
    
    <ul>
        <li><strong>Nama:</strong> {{ $userData['name'] }}</li>
        <li><strong>Email:</strong> {{ $userData['email'] }}</li>
        <li><strong>No WhatsApp:</strong> {{ $userData['no_wa'] }}</li>
    </ul>

    <p><strong>Setelah acara selesai, silahkan cek email anda untuk klaim sertifikat.</strong></p>

    <p>Terima kasih atas perhatian Anda. Semoga harimu menyenangkan!</p>
</body>
</html>
