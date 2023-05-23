<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationConfirmation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PendaftaranController extends Controller
{
    public function daftar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users',
            'no_wa' => 'required|min:11|max:13',
        ]);

        if($validator->fails()) {
            Alert::error('<p style="font-size:16px; font-weight:bold">Pendaftaran gagal.<br>Silahkan coba lagi.<p>');        
            return back();
        } else {
            Mail::to($request->email)->send(new RegistrationConfirmation($request->except('_token')));
            Alert::success('<p style="font-size:16px; font-weight:bold">Pendaftaran berhasil.<br>Silahkan cek Email Anda.<p>');        
            $insert = User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'no_wa' => $request->no_wa,
                'status_id' => 1,
                'level_id' => 1
            ]);
            return redirect()->route('home');
        }
    }
}
