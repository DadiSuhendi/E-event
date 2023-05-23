<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use DateTimeZone;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {
        $event = Event::where('status', 'aktif')->first();

        $eventDateTime = Carbon::parse($event->tanggal . ' ' . $event->jam)->timezone('Asia/Jakarta');
        $currentTime = Carbon::now(new DateTimeZone('Asia/Jakarta'));

        $eventTime = Carbon::parse($event->jam);

        // if(date('d-m-Y H:i:s')->gt($eventDateTime)) {
        //     dd('daftar');
        // } else {
        //     dd('acara dimulai');
        // }

        if ($currentTime->gt($eventDateTime)) {
            $registrationStatus = 'closed';
        } else {
            $registrationStatus = 'open';
        }

        // $isRegistrationClosed = $currentTime->gt($eventDateTime);
        // $isRegistrationOpen = $currentTime->lt($eventDateTime);
        $excerpt = Str::limit($event->deskripsi, 150);
        return view('index', [
            'event' => $event,
            'excerpt' => $excerpt,
            'registrationStatus' => $registrationStatus
            // 'isRegistrationClosed' => $isRegistrationClosed,
            // 'isRegistrationOpen' => $isRegistrationOpen,
        ]);
    }
}
