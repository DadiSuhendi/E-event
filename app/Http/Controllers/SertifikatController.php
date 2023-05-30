<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;

class SertifikatController extends Controller
{
    public function index($id)
    {
        $user = User::where('random_id', $id)->first();
        $event = Event::where('id', $user->event_id)->first();
        return view('sertifikat', [
            'user' => $user,
            'event' => $event
        ]);
    }
}
