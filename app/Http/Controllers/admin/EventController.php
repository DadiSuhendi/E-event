<?php

namespace App\Http\Controllers\admin;

use App\Models\Event;
use App\Models\Pemateri;
use App\Models\Keuntungan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.event.index', [
            'title' => 'Data Event',
            'events' => Event::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event.tambah', [
            'title' => 'Tambah Data Event',
            'pemateris' => Pemateri::all(),
            'keuntungans' => Keuntungan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipe' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'harga' => 'required|numeric'
        ]);
        if($validator->fails()) {
            Alert::toast('<p style="font-size:16px; font-weight:bold">Data Keuntungan Gagal Ditambahkan.<br>Silahkan Coba Lagi.<p>', 'error')->autoClose(2000)->timerProgressBar();
            return redirect()->route('keuntungan.index');
        }

        $event = new Event;
        $event->tipe = $request->tipe;
        $event->judul = $request->judul;
        $event->slug = Str::slug($request->judul);
        $event->deskripsi = $request->deskripsi;
        $event->tanggal = $request->tanggal;
        $event->tanggal_selesai = $request->tanggal_selesai;
        $event->jam = $request->jam;
        $event->harga = $request->harga;
        if($request->file('gambar')) {
            $uploadImage = Storage::disk('upload_images')->put('foto_event', $request->file('gambar'));   
            $event->gambar = $uploadImage;
        }
        $event->save();
        $event->pemateris()->attach($request->input('pemateris'));
        $event->keuntungans()->attach($request->input('keuntungans'));
        Alert::toast('<p style="font-size:16px; font-weight:bold">Data Keuntungan Berhasil Ditambahkan.<p>', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('data-event.index'); 
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
        $event = Event::with('pemateris')->find($id);
        $idPemateri = $event->pemateris->pluck('id')->toArray();
        $idKeuntungan = $event->keuntungans->pluck('id')->toArray();
        return view('admin.event.edit', [
            'title' => 'Edit Data Event',
            'event' => Event::with('pemateris')->find($id),
            'idPemateri' => $idPemateri,
            'idKeuntungan' => $idKeuntungan,
            'pemateris' => Pemateri::get(),
            'keuntungans' => Keuntungan::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'tipe' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'harga' => 'required|numeric',
        ]);

        if($validator->fails()) {
            Alert::toast('<p style="font-size:16px; font-weight:bold">Data Keuntungan Gagal Diubah.<br>Silahkan Coba Lagi.<p>', 'error')->autoClose(2000)->timerProgressBar();
            return redirect()->route('data-event.index');
        }

        $event = Event::find($id);
        $event->pemateris()->sync($request->pemateris);
        $event->keuntungans()->sync($request->keuntungans);
        $event->tipe = $request->tipe;
        $event->judul = $request->judul;
        $event->slug = Str::slug($request->judul);
        $event->deskripsi = $request->deskripsi;
        $event->tanggal = $request->tanggal;
        $event->tanggal_selesai = $request->tanggal_selesai;
        $event->jam = $request->jam;
        $event->harga = $request->harga;
        if($request->file('gambar')) {
            if($request->oldImage) {
                File::delete('uploads/' . $request->file('gambar'));
            }
            $uploadImage = Storage::disk('upload_images')->put('foto_event', $request->file('gambar'));   
        } else {
            $uploadImage = $request->oldImage;
        }
        $event->gambar = $uploadImage;
        $event->save();
        Alert::toast('<p style="font-size:16px; font-weight:bold">Data Keuntungan Berhasil Diubah.<p>', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('data-event.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);
        if($event->gambar) {
            File::delete('uploads/' . $event->gambar);
        }
        $event->delete();
        if(!$event) {
            Alert::toast('<p style="font-size:16px; font-weight:bold">Data Event Gagal Dihapus.<br>Silahkan Coba Lagi.<p>', 'error')->autoClose(2000)->timerProgressBar();
            return redirect()->route('data-event.index'); 
        }

        Alert::toast('<p style="font-size:16px; font-weight:bold">Data Event Berhasil Dihapus.<p>', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('data-event.index');
    }

    public function updateStatus(String $id)
    {
        $event = Event::find($id);
        if($event->status == 'aktif') {
            $event->status = 'nonaktif';
        } else {
            Event::where('status', 'aktif')->update(['status' => 'nonaktif']);
            $event->status = 'aktif';
        }
        $event->save();
        if(!$event) {
            Alert::toast('<p style="font-size:16px; font-weight:bold">Data Event Gagal Ditampilkan.<br>Silahkan Coba Lagi.<p>', 'error')->autoClose(2000)->timerProgressBar();
            return redirect()->route('data-event.index');
        }
            Alert::toast('<p style="font-size:16px; font-weight:bold">Data Event Berhasil Ditampilkan.<p>', 'success')->autoClose(2000)->timerProgressBar();
            return redirect()->route('data-event.index');

    }
}
