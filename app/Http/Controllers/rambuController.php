<?php

namespace App\Http\Controllers;
use App\jenis_rambu;
use App\rambu;
use IDCrypt;
use Illuminate\Http\Request;

class rambuController extends Controller
{

    public function jenis_rambu_index(){

        $jenis_rambu= jenis_rambu::all();
        return view('jenis_rambu.index',compact('jenis_rambu'));
    }

    public function jenis_rambu_add(Request $request){

      //  dd($request);
        $this->validate(request(),[
            'nama_jenis'=>'required|unique:jenis_rambu'
          ]);
          $jenis_rambu = new jenis_rambu;
          $jenis_rambu->nama_jenis= $request->nama_jenis;
          $jenis_rambu->save();

            return redirect(route('jenis_rambu_index'))->with('success', 'Data Jenis rambu '.$request->nama_jenis.' Berhasil di Simpan');
    }

    public function jenis_rambu_edit($id){
        $id = IDCrypt::Decrypt($id);
        $jenis_rambu = jenis_rambu::findOrFail($id);
        return view('jenis_rambu.edit',compact('jenis_rambu'));
    }


    public function jenis_rambu_update(Request $request, $id){
        $id = IDCrypt::Decrypt($id);
        $jenis_rambu = jenis_rambu::findOrFail($id);
        $this->validate(request(),[
           'nama_jenis'=>'required'
       ]);
       $jenis_rambu->nama_jenis= $request->nama_jenis;
       $jenis_rambu->update();
       return redirect(route('jenis_rambu_index'))->with('success', 'Data Jenis rambu '.$request->nama_rambu.' Berhasil di Ubah');
      }//fungsi mengubah data jenis rambu

      public function jenis_rambu_hapus($id){
        $id = IDCrypt::Decrypt($id);
        $jenis_rambu=jenis_rambu::findOrFail($id);
        $jenis_rambu->rambu()->delete();
        $jenis_rambu->delete();
        return redirect(route('jenis_rambu_index'))->with('success', 'Data  Berhasil di hapus');
    } //menghapus  data jenis rambu

    public function rambu_index(){

        $jenis_rambu= jenis_rambu::all();
        $rambu= rambu::all();
        return view('rambu.index',compact('jenis_rambu','rambu'));
    }

    public function rambu_add(Request $request){
       // dd($request);
        $this->validate(request(),[
            'kode_rambu'=>'required|unique:rambu',
            'nama_rambu'=>'required|unique:rambu',
            'jenis_id'=>'required',
            'gambar'=>'required'
        ]);
        $rambu = new rambu;
        $FotoExt  = $request->gambar->getClientOriginalExtension();
        $FotoName = $request->kode_rambu.' - '.$request->nama_rambu;
        $gambar     = $FotoName.'.'.$FotoExt;
        $request->gambar->move('images/rambu', $gambar);

        $rambu->kode_rambu= $request->kode_rambu;
        $rambu->nama_rambu= $request->nama_rambu;
        $rambu->jenis_rambu_id= $request->jenis_id;
        $rambu->keterangan= $request->keterangan;
        $rambu->gambar            = $gambar;
        $rambu->save();

          return redirect(route('rambu_index'))->with('success', 'Data rambu '.$request->nama_rambu.' Berhasil di Tambahkan');
      }//fungsi menambahkan data rambu


      public function rambu_edit($id){
        $id = IDCrypt::Decrypt($id);
        $rambu = rambu::findOrFail($id);
        $jenis_rambu= jenis_rambu::all();
        return view('rambu.edit',compact('rambu','jenis_rambu'));
       }//fungsi menampilkan detail data rambu

}