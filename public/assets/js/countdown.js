function countdown(tanggal, jam) {
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
            tombolDaftarHadir();
        }
    }, 1000);
}