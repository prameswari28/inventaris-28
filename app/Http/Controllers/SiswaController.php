<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * index
     * 
     * @return void
     */

     public function index()
     {
        //get siswa
        $siswa = Siswa::latest()->paginate(5);

        //render view with posts
        return view('siswa.index', compact('siswa'));
     }

   public function create()
   {
      return view('siswa.create');
   }

      /**
       * store
       * 
       * @param Request $request
       * @return void
       */

       

       public function store(Request $request)
       {
         //validate form

         $this->validate($request, [
            'nama' => 'required',
            'kelas' => 'required',
         ]);

          //create post
        Siswa::create([
         'nama'     => $request->input('nama'),
         'kelas'   => $request->input('kelas'),
     ]);

         //redirect to index
         return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Disimpan!']);
       }
       

       //edit
       public function edit(Siswa $siswa)
       {
           return view('siswa.edit', compact('siswa'));
       }

       public function update(Request $request, Siswa $siswa)
       {
           //validate form
           $this->validate($request, [
               'nama'     => 'required',
               'kelas'   => 'required'
           ]);

           $siswa->update([
            'nama'     => $request->nama,
            'kelas'   => $request->kelas,
           ]);

           return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Diubah!']);
         }

           //delete
           public function destroy(Siswa $siswa)
           {
               $siswa->delete();
               //redirect to index
               return redirect()->route('siswa.index')->with(['success' => 'Data Berhasil Dihapus!']);
   }
}
