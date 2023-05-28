<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Event;
use App\Models\Level;
use App\Mail\DaftarHadir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmation;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = User::where('email', '<>', auth()->user()->email)->get();
        $user = User::whereNotIn('id', [Auth::id()])->get();
        $event = Event::get();
        return view('admin.pengguna.index', [
            'title' => 'Data Pengguna',
            'users' => $user,
            'events' => $event
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengguna.tambah', [
            'title' => 'Tambah Data Pengguna',
            'levels' => Level::get(),
            'events' => Event::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|email',
            'no_wa' => 'required|numeric',
            'level_id' => 'required',
            'event_id' => 'required'
        ]);

        $cekEmail = User::where('email', $request->email)->where('event_id', $request->event_id)->first();

        if($cekEmail) {
            Alert::error('<p style="font-size:16px; font-weight:bold">Email sudah terdaftar.<br>Silahkan coba lagi.<p>');
            return back();
        }

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'no_wa' => $request->no_wa,
            'level_id' => $request->level_id,
            'event_id' => $request->event_id,
        ]);
        if($request->level_id != 2) {
            Mail::to($request->email)->send(new RegistrationConfirmation($request->except('_token')));
        }
        Alert::success('<p style="font-size:16px; font-weight:bold">Tambah Pengguna berhasil.<p>');
        return redirect()->route('pengguna.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $levels = Level::get();
        $events = Event::get();
        $level = Level::where('id', $user->level_id)->first();
        $event = Event::where('id', $user->event_id)->first();
        return view('admin.pengguna.edit', [
            'title' => 'Edit Data Pengguna',
            'user' => $user,
            'levels' => $levels, 
            'level' => $level ,
            'events' => $events, 
            'event' => $event 
        ]);
    }

    /**
  * Update the pecified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = $request->validate([
            'name' => 'required|min:3|max:100',
            'no_wa' => 'required|numeric',
            'level_id' => 'required',
            'event_id' => 'required'
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'no_wa' => $request->no_wa,
            'level_id' => $request->level_id,
            'event_id' => $request->event_id,
        ]);
        Alert::success('<p style="font-size:16px; font-weight:bold">Ubah Data Pengguna berhasil.<p>');
        return redirect()->route('pengguna.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        Alert::toast('<p style="font-size:16px; font-weight:bold">Data Pengguna Berhasil Dihapus.<p>', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('pengguna.index');
    }
}
