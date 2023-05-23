<?php

namespace App\Http\Controllers\admin;

use App\Models\Keuntungan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class KeuntunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.keuntungan.index', [
            'title' => 'Data Keuntungan',
            'keuntungans' => Keuntungan::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.keuntungan.tambah', [
            'title' => 'Tambah Data Keuntungan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keuntungan' => 'required'
        ]);

        if($validator->fails()) {
            Alert::toast('<p style="font-size:16px; font-weight:bold">Data Keuntungan Gagal Ditambahkan.<br>Silahkan Coba Lagi.<p>', 'error')->autoClose(2000)->timerProgressBar();
            return redirect()->route('keuntungan.index');
        }
        Alert::toast('<p style="font-size:16px; font-weight:bold">Data Keuntungan Berhasil Ditambahkan.<p>', 'success')->autoClose(2000)->timerProgressBar();
        Keuntungan::insert([
            'keuntungan' => $request->keuntungan
        ]);
        return redirect()->route('keuntungan.index'); 
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
        return view('admin.keuntungan.edit', [
            'title' => 'Edit Data Keuntungan',
            'keuntungan' => Keuntungan::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'keuntungan' => 'required'
        ]);

        if($validator->fails()) {
            Alert::toast('<p style="font-size:16px; font-weight:bold">Data Keuntungan Gagal Diubah.<br>Silahkan Coba Lagi.<p>', 'error')->autoClose(2000)->timerProgressBar();
            return redirect()->route('keuntungan.index');
        }
        Alert::toast('<p style="font-size:16px; font-weight:bold">Data Keuntungan Berhasil Diubah.<p>', 'success')->autoClose(2000)->timerProgressBar();
        Keuntungan::where('id', $id)->update([
            'keuntungan' => $request->keuntungan
        ]);
        return redirect()->route('keuntungan.index'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroy = Keuntungan::destroy($id);
        if(!$destroy) {
            Alert::toast('<p style="font-size:16px; font-weight:bold">Data Keuntungan Gagal Dihapus.<br>Silahkan Coba Lagi.<p>', 'error')->autoClose(2000)->timerProgressBar();
            return redirect()->route('keuntungan.index'); 
        }

        Alert::toast('<p style="font-size:16px; font-weight:bold">Data Keuntungan Berhasil Dihapus.<p>', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('keuntungan.index');

    }
}
