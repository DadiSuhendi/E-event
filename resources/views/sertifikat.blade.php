<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/sertifikat.css">
    <style>
    </style>
</head>
<body onload="window.print();">
    <div class="container">
        <div class="outer-bg">
            <img src="/images/1.png" alt="" style="width: 1000px; height: 1000px;">
            <div class="desc">
                <div class="title">
                    <span>SERTIFIKAT</span>
                    <br>
                    <span>{{ strtoupper($event->tipe) }}</span>
                </div>
                <br><br>
                <div class="to">DIBERIKAN KEPADA</div>
                <br>
                <div class="name">{{ strtoupper($user->name) }}</div>
                <br>
                @php
                    \Carbon\Carbon::setLocale('id');
                @endphp
                <div class="text">Atas partisipasinya sebagai peserta {{ strtolower($event->tipe) . ' ' . $event->judul }}. <br> Pada tanggal {{ Carbon\Carbon::parse($event->tanggal)->isoFormat('D MMMM Y') }}</div>
                <div class="ttd">
                    <span>{{ Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</span>
                    <br><br><br>
                    <hr>
                    <span>TTD</span>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>