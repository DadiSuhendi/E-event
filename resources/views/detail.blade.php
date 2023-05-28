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
<body>
    <div class="w-full bg-white font-raleway px-8 lg:px-36">
        <nav class="bg-white border-gray-200 z-20">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-5">
                <a href="">
                    <span class="text-lg">{{ $event->tipe }}</span>
                </a>
                <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-900 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 transition ease-in-out" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul class="font-medium flex flex-col py-4 md:p-0 mt-4 border-t-2 border-b-2 border-primary rounded-lg bg-white md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="/" class="block py-2 text-center text-primary bg-gray-900 hover:bg-gray-800 rounded md:py-2 md:px-4 md:bg-gray-900 md:text-primary" aria-current="page">
                            @if ($registrationStatus == 'closed')
                                Isi Daftar Hadir
                            @else
                                Daftar Sekarang
                            @endif
                        </a>
                    </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <header class="w-full bg-primary font-raleway py-9 px-8 lg:px-36">
        <div class="md:flex items-center justify-between">
            <span class="font-bold text-center md:text-left md:text-xl lg:text-2xl text-lg block"><h1>{{ $event->tipe }}</h1>tentang {{ $event->judul }}</span>
            <img src="/assets/img/dummy1.jpg" class="mt-2 md:h-2/5 md:w-2/5">
        </div>
    </header>
    <main class="w-full bg-white font-raleway py-9 px-8 text-base lg:px-36">
        <div class="text-justify" id="description">{!! $event->deskripsi !!}</div>
        <div class="pt-9" id="benefit">
            <h1 class="font-bold text-lg">{{ $event->tipe }} {{ $event->judul }} memiliki berbagai manfaat, antara lain:</h1>
            <ol class="list-decimal px-8 text-base pt-2">
                @foreach ($event->keuntungans as $keuntungan)
                    <li>{{ $keuntungan->keuntungan }}</li>
                @endforeach
            </ol>
        </div>
        <div class="pt-9" id="speaker">
            <h1 class="font-bold text-lg pb-2">Pemateri</h1>
            <div class="md:flex md:items-center md:gap-4">
                @foreach ($event->pemateris as $pemateri)
                <div id="cards" class="w-full md:w-2/5 flex flex-wrap bg-primary rounded-md p-5">
                    <div class="flex">
                        <div class="w-[50px] h-[50px] rounded-full overflow-hidden">
                            <img src="{{ asset('uploads/' . $pemateri->gambar_pemateri) }}">
                        </div>
                        <div class="flex flex-col justify-center pl-5">
                            <p class="text-base text-gray-900">{{ $pemateri->nama_pemateri }}</p>
                            <span class="text-gray-500 text-sm">{{ $pemateri->gelar_pemateri }}</span>
                        </div>
                    </div>
                    <span class="pt-3 text-justify text-sm">{!! $pemateri->deskripsi_pemateri !!}</span>
                </div>
                @endforeach
            </div>
        </div>
    </main>
    <footer class="mt-9 text-center py-4 bg-primary">
        <p class="text-gray-900">Copyright &copy; <b>E-Event.</b> 2023</p>
    </footer>
</body>
</html>