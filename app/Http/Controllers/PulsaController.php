<?php

namespace App\Http\Controllers;

use App\Models\Pulsa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PulsaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pulsas = Pulsa::all();
        return view('pulsa.index', [
            'pulsas' => $pulsas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $providers = \App\Models\Provider::all();
        return view('pulsa.create', [
            'providers' => $providers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate form
        $this->validate($request, [
            'id_provider' => 'required|integer',
            'gambar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'jenis_pulsa' => 'required|min:3',
            'harga' => 'required|min:2'
        ]);

        // upload image
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/pulsas', $gambar->hashName());

        // create pulsa
        Pulsa::create([
            'id_provider' => $request->id_provider,
            'gambar' => $gambar->hashName(),
            'jenis_pulsa' => $request->jenis_pulsa,
            'harga' => $request->harga
        ]);

        //redirect to index
        return redirect(route('daftarPulsa'))->with('success', 'Data Berhasil Di simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pulsa $pulsa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $providers = \App\Models\Provider::all();
        $pulsa = Pulsa::findOrFail($id);
        return view('pulsa.edit', [
                'pulsa' => $pulsa,
                'providers' => $providers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //validasi form
        $this->validate($request, [
            'id_provider' => 'required|integer',
            'gambar' => 'image|mimes:jpeg,jpg,png|max:2048',
            'jenis_pulsa' => 'required|min:3',
            'harga' => 'required|min:2',
        ]);

        //untuk mengambil ID Pulsa
        $pulsa = Pulsa::findOrFail($id);

        //cek apabila gambar akan di upload
        if ($request->hasFile('gambar')) {

            //upload gambar baru
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/pulsas', $gambar->hashName());

            //hapus gambar lama
            Storage::delete("public/pulsas" . $pulsa->gambar);

            //update pulsa dengan gambar baru
            $pulsa->update([
            'id_provider' => $request->id_provider,
            'gambar' => $gambar->hashName(),
            'jenis_pulsa' => $request->jenis_pulsa,
            'harga' => $request->harga
            ]);
        } else {

            //update pulsa tanpa gambar
            $pulsa->update([
            'id_provider' => $request->id_provider,
            'jenis_pulsa' => $request->jenis_pulsa,
            'harga' => $request->harga
            ]);
        }

        //mengarahkan ke halaman index pulsa
        return redirect(route('daftarPulsa'))->with('success', 'Data Berhasil Di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pulsa = Pulsa::findOrFail($id);

        Storage::delete('public/pulsas/'. $pulsa->gambar);
        $pulsa->delete();
        return redirect(route('daftarPulsa'))->with('success', 'Data Berhasil Di hapus');
    }
}
