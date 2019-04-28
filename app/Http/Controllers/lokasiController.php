<?php

namespace App\Http\Controllers;
use App\kecamatan;
use App\kelurahan;
use IDCrypt;
use Illuminate\Http\Request;

class lokasiController extends Controller
{
    //funsi kecamatan
    public function kecamatan_index(){

        $kecamatan = kecamatan::all();

        return (view('kecamatan.index',compact('kecamatan')));
    }

    public function kecamatan_add(Request $request){

        //  dd($request);
          $this->validate(request(),[
              'kode_kecamatan'=>'required|unique:kecamatan',
              'nama_kecamatan'=>'required'
            ]);
            $kecamatan = new kecamatan;
            $kecamatan->kode_kecamatan= $request->kode_kecamatan;
            $kecamatan->nama_kecamatan= $request->nama_kecamatan;
            $kecamatan->save();

              return redirect(route('kecamatan_index'))->with('success', 'Data Jenis rambu '.$request->nama_kecamatan.' Berhasil di Simpan');
      }
      public function kecamatan_delete($id){
            $id = IDCrypt::Decrypt($id);
            $kecamatan=kecamatan::findOrFail($id);
            $kecamatan->delete();
            return redirect(route('kecamatan_index'))->with('success', 'Data  Berhasil di hapus');
    } //menghapus  data kecamatan



        //funsi kelurahan
        public function kelurahan_index(){

          $kelurahan = kelurahan::all();
          $kecamatan = kecamatan::all();

          return (view('kelurahan.index',compact('kelurahan','kecamatan')));
      }

      public function kelurahan_add(Request $request){

           // dd($request);
            $this->validate(request(),[
                'kode_kelurahan'=>'required|unique:kelurahan',
                'nama_kelurahan'=>'required',
                'kecamatan_id'=>'required'

              ]);
              $kelurahan = new kelurahan;
              $kelurahan->kode_kelurahan= $request->kode_kelurahan;
              $kelurahan->nama_kelurahan= $request->nama_kelurahan;
              $kelurahan->kecamatan_id= $request->kecamatan_id;
              $kelurahan->save();

                return redirect(route('kelurahan_index'))->with('success', 'Data Berhasil di Simpan');
        }

        public function kelurahan_edit($id){
            $id = IDCrypt::Decrypt($id);
            $kelurahan=kelurahan::findOrFail($id);
            $kecamatan= kecamatan::all();
            return (view('kelurahan.edit',compact('kelurahan','kecamatan')));
        } //menghapus  data kecamatan

        public function kelurahan_delete($id){
              $id = IDCrypt::Decrypt($id);
              $kelurahan=kelurahan::findOrFail($id);
              $kelurahan->delete();
              return redirect(route('kelurahan_index'))->with('success', 'Data  Berhasil di hapus');
      } //menghapus  data kecamatan


}