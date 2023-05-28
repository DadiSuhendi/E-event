<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class RiwayatController extends Controller
{
    public function index()
    {
        $events = Event::where('status_event', 'selesai')->get();
        return view('admin.riwayat.index', [
            'title' => 'Riwayat Event',
            'events' => $events,
            'users' => User::get()
        ]);
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        if($event->gambar) {
            File::delete('uploads/' . $event->gambar);
        }
        $event->delete();
        if(!$event) {
            Alert::toast('<p style="font-size:16px; font-weight:bold">Data Event Gagal Dihapus.<br>Silahkan Coba Lagi.<p>', 'error')->autoClose(2000)->timerProgressBar();
            return redirect()->route('riwayat'); 
        }

        Alert::toast('<p style="font-size:16px; font-weight:bold">Data Event Berhasil Dihapus.<p>', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('riwayat');
    }
}
