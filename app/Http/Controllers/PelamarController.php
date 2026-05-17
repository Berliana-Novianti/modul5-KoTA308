<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PelamarController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 1. Upload foto ke Azure Blob Storage
        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
        
        // Simpan ke folder 'pendaftaran' di dalam container
        Storage::disk('azure')->put('pendaftaran/' . $fileName, file_get_contents($file));

        // 2. Ambil URL Publik file tersebut
        $url = Storage::disk('azure')->url('pendaftaran/' . $fileName);

        return "FILE SUKSES TERUPLOAD! URL: " . $url;

        // 3. Simpan data ke Azure MySQL
        DB::table('pelamar')->insert([
            'nama' => $request->nama,
            'email' => $request->email,
            'ktp_url' => $url,
        ]);

        return "Data berhasil disimpan! Foto tersimpan di Object Storage dan URL tersimpan di Database.";
    }
}