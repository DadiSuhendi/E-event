<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Status;
use App\Mail\DaftarHadir;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PendaftaranController extends Controller
{
    public function daftar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'no_wa' => 'required|min:11|max:13',
        ]);

        if($validator->fails()) {
            Alert::error('<p style="font-size:16px; font-weight:bold">Pendaftaran gagal.<br>Silahkan coba lagi.<p>');        
            return back();
        } else {
            $event = Event::where('status', 'aktif')->first();

            $user = User::where('email', $request->email)->where('event_id', $event->id)->first();
            
            if($user) {
                Alert::error('<p style="font-size:16px; font-weight:bold">Email sudah terdaftar.<p>');
                return redirect()->route('home');        
            }

            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'no_wa' => $request->no_wa,
                'status_id' => 1,
                'event_id' => $event->id,
                'level_id' => 1
            ]);
            Mail::to($request->email)->send(new RegistrationConfirmation($request->except('_token')));
            Alert::success('<p style="font-size:16px; font-weight:bold">Pendaftaran berhasil.<br>Silahkan cek Email Anda.<p>');      
            return redirect()->route('home');
        }
    }

    public function daftarHadir(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);
        $event = Event::where('status', 'aktif')->first();

        $cekEmail = User::where('email', $request->email)->where('event_id', $event->id)->first();

        if(!$cekEmail || $cekEmail->level_id == 2) {
            Alert::error('<p style="font-size:16px; font-weight:bold">Email tidak terdaftar.<p>');
            return redirect()->route('home');
        }
        
        if($cekEmail->status_id == 2) {
            Alert::error('<p style="font-size:16px; font-weight:bold">Email ini sudah mengisi daftar hadir.<p>');
            return redirect()->route('home');
        }

        $cekEmail->status_id = 2;
        $cekEmail->save();
        Mail::to($request->email)->send(new DaftarHadir($cekEmail));
        Alert::success('<p style="font-size:16px; font-weight:bold">Isi daftar hadir berhasil.<br>Silahkan cek Email Anda.<p>');
        return redirect()->route('home');
    }
}
