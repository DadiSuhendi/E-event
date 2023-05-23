<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins:wght@400;600;700&family=Raleway:wght@400;700&family=Roboto:wght@400;700&display=swap');
    </style>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="overflow-x-hidden">
    @include('sweetalert::alert')
    <div class="md:flex w-screen bg-black">
        <div class="w-full bg-primary font-raleway px-8 pt-9 md:w-1/2 lg:px-32">
            <header class="text-center">
                <h1 class="text-2xl">{{ $event->tipe }}</h1>
                <p class="text-base">tentang</p>
                <h2 class="text-2xl">{{ $event->judul }}</h2>
            </header>
            <div class="box w-full  bg-white rounded-md mt-9 p-5 text-base">
                <p class="text-gray-500">{!! $excerpt !!} <a href="/detail" class="font-bold hover:text-gray-600">Baca Selengkapnya.</a></p>
            </div>
            <div class="box2 w-full bg-white rounded-md mt-9 p-5 text-base text-gray-500">
                <table>
                    <tr>
                        <td>Tanggal Kegiatan</td>
                        <td valign="top">:&nbsp;</td>
                        @if ($event->tanggal_selesai != null)
                            <td>{{ Carbon\Carbon::parse($event->tanggal)->format('d F Y')}} -  {{ Carbon\Carbon::parse($event->tanggal_selesai)->format('d F Y')}}</td>
                        @else
                            <td>{{ Carbon\Carbon::parse($event->tanggal)->format('d F Y') }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>Jam Kegiatan</td>
                        <td valign="top">:&nbsp;</td>
                        <td>{{ $event->jam }} s/d Selesai</td>
                    </tr>
                    <tr>
                        <td>Biaya</td>
                        <td valign="top">:&nbsp;</td>
                        <td><b>
                            @if ($event->harga == 0)
                                Gratis
                            @else
                            {{ 'Rp ' . number_format($event->harga, 0, ',', '.') }}
                            @endif    
                        </b></td>
                    </tr>
                </table>
            </div>
            <div class="box2 w-full bg-white rounded-md mt-4 p-5 text-base text-gray-500 flex  items-center" id="countdownParent">
                <span id="countdown" class="text-lg text-bold text-center"></span>
                <div id="hari"></div>
                <div id="jam"></div>
                <div id="menit"></div>
                <div id="detik"></div>
            </div>
            @if($registrationStatus == 'closed')
                @include('layouts.tombolIsiKehadiran')
            @else
                @include('layouts.tombolDaftar')
            @endif

            <button class="w-full bg-white border border-btnPrimary mt-4 mb-9 text-gray-900 px-5 py-2.5 mr-2 rounded-md hover:bg-whatsapp hover:text-primary text-base" id="copyBtn">Salin ke Clipboard</button>
            <footer class="text-center pb-9 bg-primary text-base">
                <p class="text-gray-900">Copyright &copy; <b>E-Event.</b> 2023</p>
            </footer>
        </div>
        <div class="md:w-1/2">
            <div class="md:bg-cover md:bg-center w-full h-full" style="background-image: url(/assets/img/dummy1.jpg)"></div>
        </div>
    </div>
    
<!-- Modal toggle -->
  
  <!-- Main modal -->
  
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        var now = new Date().getTime();

        var targetDate = "{{ $event->tanggal }}";
        var targetTime = "{{ $event->jam }}";
        var targetDateTime = new Date(targetDate + ' ' + targetTime).getTime();

        var timeRemaining = targetDateTime - now;

        var countdownInterval = setInterval(function() {
            var now = new Date().getTime();

            var timeRemaining = targetDateTime - now;

            var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
            
            
            document.getElementById("countdown").style.display = "none";
            document.getElementById("countdownParent").classList.add("justify-between");
            document.getElementById('hari').innerHTML = `<span class="text-xl font-roboto">${days}</span><span class="text-sm"> Hari</span>`
            document.getElementById('jam').innerHTML = `<span class="text-xl font-roboto">${hours}</span><span class="text-sm"> Jam</span>`
            document.getElementById('menit').innerHTML = `<span class="text-xl font-roboto">${minutes}</span><span class="text-sm"> Menit</span>`
            document.getElementById('detik').innerHTML = `<span class="text-xl font-roboto">${seconds}</span><span class="text-sm"> Detik</span>`
            
            if (timeRemaining <= 0) {
                clearInterval(countdownInterval);
                document.getElementById("countdownParent").classList.add("justify-center");
                document.getElementById("countdownParent").classList.remove("justify-between");
                document.getElementById("countdown").style.display = "block";
                document.getElementById("countdown").innerHTML = "Acara sedang dimulai";
                document.getElementById('hari').style.display = 'none'
                document.getElementById('jam').style.display = 'none'
                document.getElementById('menit').style.display = 'none'
                document.getElementById('detik').style.display = 'none'

            }
        }, 1000);
    </script>
    <script src="/assets/js/copyToClipboard.js"></script>
</body>
</html>