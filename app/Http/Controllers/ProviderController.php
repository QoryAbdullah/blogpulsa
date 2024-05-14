<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers = Provider::all();
        return view('provider.index', [
            'providers' => $providers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('provider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(), [
            'nama_provider' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ])->validated();

        $provider = new Provider($validatedData);
        $provider->save();

        return redirect(route('daftarProvider'))->with('success', 'Data Berhasil Di simpan');
    }



    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $provider = Provider::findOrFail($id);
        return view('provider.edit', [
            'provider' => $provider
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = validator($request->all(), [
            'nama_provider' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ])->validated();

        $provider = Provider::findOrFail($id);
        
        $provider->update([
            'nama_provider' => $request->nama_provider,
            'keterangan' => $request->keterangan
        ]);

        return redirect(route('daftarProvider'))->with('success', 'Data Berhasil Di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $provider = Provider::findOrFail($id);
        $provider->delete();
        return redirect(route('daftarProvider'))->with('success', 'Data Berhasil Di hapus');
    }
}
