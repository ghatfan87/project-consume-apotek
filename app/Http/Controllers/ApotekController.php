<?php

namespace App\Http\Controllers;

use App\Http\Libraries\BaseApi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class ApotekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        // memanggil libraries BaseApi method index nya dengan mengirim parameter1 berupa path data dari API nya,parameter2 data untuk mengisi search_name API nya
        // new :  memanggil class
        $data = (new BaseApi)->index('/apotek', ['search_apoteker' => $search]);
        // ambil response json nya
        $apoteks = $data->json();
        // dd($students);
        // kirim hasil pengambilan data ke blade index
        //  
        return view('index')->with(['apoteks' => $apoteks['data']]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $harga_satuan = explode(',', $request->harga_satuan);
        $total_harga = 0;
        foreach ($harga_satuan as $harga) {
            $harga = (int) trim($harga, '"');
            $total_harga += $harga;

            $data = [
                'nama' => $request->nama,
                'rujukan' => $request->rujukan,
                'rumah_sakit' => $request->rujukan == 1 ? $request->rumah_sakit : null,
                'obat' => $request->obat,
                'harga_satuan' => $request->harga_satuan,
                'total_harga' => $total_harga,
                'apoteker' => $request->apoteker,
            ];
             
            $proses = (new BaseApi)->store('/apoteks/tambah-data',$data);
            if($proses->failed()) {
                $errors=$proses->json('data');
                return redirect()->back()->with(['errors' => $errors]);
            }else {

                return redirect('/')->with('toast_success','Berhasil Menambahkan Data Baru');
            }
        }
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
    public function edit($id)
    {
        $data = (new BaseApi)->edit('/apoteks/'.$id);
        if($data->failed()){
            dd($data);
        $errors = $data->json('data');
        return redirect()->back()->with(['errors' => $errors]);
        }else {
            $apoteks = $data->json('data');
            return view('edit')->with(['apoteks' => $apoteks]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $harga_satuan = explode(',', $request->harga_satuan);
        $total_harga = 0;
        foreach ($harga_satuan as $harga) {
            $harga = (int) trim($harga, '"');
            $total_harga += $harga;

            $payload = [
            'nama' => $request->nama,
            'rujukan' => $request->rujukan,
            'rumah_sakit' => $request->rujukan == 1 ? $request->rumah_sakit : null,
            'obat' => $request->obat,
            'harga_satuan' => $request->harga_satuan,
            'total_harga' => $total_harga,
            'apoteker' => $request->apoteker,
            ];
        }
        $proses = (new BaseApi)->update('/apoteks/'.$id.'/update', $payload);
        if($proses->failed()) {
            // kl gagal,balikin lagi sama pesan errors dari json nya
            $errors=$proses->json('data');
            // dd($proses);
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            // berhasil, balikin halaman paling awal dengan 
            return redirect('/')->with('toast_success','Berhasil Mengubah data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proses = (new BaseApi)->delete('/apoteks/'.$id.'/delete');

        if($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
    }else {
        return redirect('/')->with('toast_success','Berhasil Menghapus data pasien!');
    }
    }

    public function trash()          
    {
        $proses = (new BaseApi)->trash('/apoteks/show/trash');
        if ($proses->failed()){
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            $ApoteksTrash =
            $proses->json('data');
            return view('trash')->with(['ApoteksTrash' => $ApoteksTrash]);
        }

    }

    public function restore($id)
    {
        $proses = (new BaseApi)->restore('/apoteks/restore/'.$id);
        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect('/')->with('toast_success', 'Berhasil mengembalikan data dari sampah!');
        }
    }

    public function deletePermanent($id)
    {
        $proses = (new BaseApi)->deletePermanent('/apoteks/delete/permanent/' .$id);
        if ($proses->failed()){
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors'=> $errors]);
        }else {
            return redirect('/')->with('toast_success', 'Berhasil hapus data secara permanent!');
        } 
    }
}

