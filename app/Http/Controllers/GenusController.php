<?php

namespace App\Http\Controllers;

use App\Models\Genus;
use Illuminate\Http\Request;

class GenusController extends Controller
{
    // Tampilkan daftar genus
    public function listGenus()
    {
        $genusList = Genus::all();
        return view('genus', compact('genusList'));
    }

    public function create()
    {
        return view('add-genus');
    }

    // Simpan genus baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:genus,name|max:255',
        ]);

        Genus::create(['name' => $request->name]);

        return redirect()->route('genus')->with('success', 'Genus berhasil ditambahkan!');
    }


    // Edit genus
    public function edit($id)
    {
        $genus = Genus::findOrFail($id);
        return view('edit-genus', compact('genus'));
    }

    // Update genus
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:genus,name,' . $id . '|max:255',
        ]);

        $genus = Genus::findOrFail($id);
        $genus->update(['name' => $request->name]);

        return redirect()->route('genus')->with('success', 'Genus berhasil diperbarui!');
    }


    // Hapus genus
    public function destroy($id)
    {
        $genus = Genus::findOrFail($id);
        $genus->delete();

        return redirect()->route('genus')->with('success', 'Genus berhasil dihapus!');
    }
}
