<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailController extends Controller
{
    public function index()
    {
        return view('detail', [
            'event' => Event::with('keuntungans', 'pemateris')->where('status', 'aktif')->first()
        ]);
    }
}
