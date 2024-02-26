<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::latest()->paginate(5);

        return view('barang.index', compact('barang'));
    }


    
    public function create()
    {
        return view('barang.create');
    }



    public function store(Request $request)
{
    $this->validate($request, [
        'nama_barang' => 'required',
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ganti 'gambar' menjadi 'image'
    ]);

    $gambar = $request->file('gambar');
    $gambar->storeAs('public/barang', $gambar->hashName());

    Barang::create([
        'nama_barang' => $request->nama_barang,
        'gambar' => $gambar->hashName(),
    ]);

    return redirect()->route('barang.index')->with(['success' => 'Data Barang Berhasil Disimpan! :D']);
}



 //
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }



    public function update(Request $request, Barang $barang)
    {
        //validate form
        $this->validate($request, [
            'nama_barang'     => 'required',
            'image'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            //upload new image
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/barang', $gambar->hashName());

            //delete old image
            Storage::delete('public/barang/'.$barang->gambar);

            //update post with new image
            $barang->update([
                'nama_barang'     => $request->nama_barang,
                'gambar'     => $gambar->hashName(),
            ]);

        } else {

            //update post without image
            $barang->update([
                'nama_barang'     => $request->nama_barang,
            ]);
        }

        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diubah!']);
    }



    public function destroy(Barang $barang)
    {
        Storage::delete('public/barang'. $barang->gambar);
        $barang->delete();
        return redirect()->route('barang.index')->with(['success' => 'Data Barang Berhasil Dihapus! :(']);
    }
}
