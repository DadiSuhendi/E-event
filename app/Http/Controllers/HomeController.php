<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index()
    {
        $event = Event::where('status', 'aktif')->first();
        if(!$event) {
            return view('errors.EventNotFound');
        }

        $currentTime = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        
        if ($currentTime->toDateTimeString() >= Carbon::parse($event->tanggal . ' ' . $event->jam)->toDateTimeString()) {
            $registrationStatus = 'closed';
        } else {
            $registrationStatus = 'open';
        }

        $excerpt = Str::limit($event->deskripsi, 150);

        return view('index', [
            'event' => $event,
            'excerpt' => $excerpt,
            'registrationStatus' => $registrationStatus
        ]);
    }
}
