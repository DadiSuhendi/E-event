<?php

namespace App\Http\Controllers\admin;

use App\Models\Pemateri;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class PemateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pemateri.index', [
            'title' => 'Data Pemateri',
            'pemateris' => Pemateri::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pemateri.tambah', [
            'title' => 'Tambah Data Pemateri'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'nama_pemateri' => 'required',
            'gelar_pemateri' => 'nullable',
            'deskripsi_pemateri' => 'required',
            'gambar_pemateri' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);
        if($validator->fails()) {
            Alert::toast('<p style="font-size:16px; font-weight:bold">Data Keuntungan Gagal Ditambahkan<br>Silahkan Coba Lagi.<p>', 'error')->autoClose(2000)->timerProgressBar();
            return redirect()->route('pemateri.index');
        }
        $pemateri = new Pemateri;
        $pemateri->nama_pemateri = $request->nama_pemateri;
        $pemateri->gelar_pemateri = $request->gelar_pemateri;
        $pemateri->deskripsi_pemateri = $request->deskripsi_pemateri;
        if($request->file('gambar_pemateri')) {
            $uploadImage = Storage::disk('upload_images')->put('foto_blog', $request->file('gambar_pemateri'));
            $pemateri->gambar_pemateri = $uploadImage;
        }          
        $pemateri->save();
        Alert::toast('<p style="font-size:16px; font-weight:bold">Data Pemateri Berhasil Ditambahkan.<p>', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('pemateri.index');  
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
        return view('admin.pemateri.edit', [
            'title' => 'Edit Data Pemateri',
            'pemateri' => Pemateri::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [ 
            'nama_pemateri' => 'required',
            'gelar_pemateri' => 'nullable',
            'deskripsi_pemateri' => 'required',
            'gambar_pemateri' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        if($validator->fails()) {
            Alert::toast('<p style="font-size:16px; font-weight:bold">Data Keuntungan Gagal Diubah<br>Silahkan Coba Lagi.<p>', 'error')->autoClose(2000)->timerProgressBar();
            return redirect()->route('pemateri.index');
        } 
        $pemateri = Pemateri::find($id);
        $pemateri->nama_pemateri = $request->nama_pemateri;
        $pemateri->gelar_pemateri = $request->gelar_pemateri;
        $pemateri->deskripsi_pemateri = $request->deskripsi_pemateri;
        
        if($request->file('gambar_pemateri')) {
            if($request->oldImage) {
                File::delete('uploads/' . $request->oldImage);
            }
            $uploadImage = Storage::disk('upload_images')->put('foto_blog', $request->file('gambar_pemateri'));
        } else {
            $uploadImage = $request->oldImage;
        }
        $pemateri->gambar_pemateri = $uploadImage;
        $pemateri->save();
        Alert::toast('<p style="font-size:16px; font-weight:bold">Data Pemateri Berhasil Diubah.<p>', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('pemateri.index');  
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemateri = Pemateri::find($id);
        if($pemateri->gambar_pemateri) {
            File::delete('uploads/' . $pemateri->gambar_pemateri);
        }
        Pemateri::destroy($id);
        Alert::toast('<p style="font-size:16px; font-weight:bold">Data Pemateri Berhasil Dihapus.<p>', 'success')->autoClose(2000)->timerProgressBar();
        return redirect()->route('pemateri.index');

    }
}
