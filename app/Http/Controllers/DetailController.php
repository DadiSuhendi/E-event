<?php

namespace App\Http\Controllers;

use DateTimeZone;
use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function index()
    {
        $event = Event::where('status', 'aktif')->where('status_event', 'belum_selesai')->first();
        if(!$event) {
            return view('errors.EventNotFound');
        }

        $currentTime = Carbon::now(new DateTimeZone('Asia/Jakarta'));
        
        if ($currentTime->toDateTimeString() >= Carbon::parse($event->tanggal . ' ' . $event->jam)->toDateTimeString()) {
            $registrationStatus = 'closed';
        } else {
            $registrationStatus = 'open';
        }
        return view('detail', [
            'event' => Event::with('keuntungans', 'pemateris')->where('status', 'aktif')->first(),
            'registrationStatus' => $registrationStatus
        ]);
    }
}
