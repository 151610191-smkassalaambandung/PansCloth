<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Lainnya;
use Session;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBookRequest;

class LainnyaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

public function index(Request $request, Builder $htmlBuilder)
    {
        $Lainnya = Lainnya::all();

     if ($request->ajax()) {
    $Lainnya = Lainnya::select(['id','cover','cover2','notlp','line','email','alamat']);
        return Datatables::of($Lainnya)
        ->addColumn('cover', function($Lainnya){
            return '<img src="/img/img1/'.$Lainnya->cover. '" height="100px" width="200px">';
        })
        ->addColumn('action', function($Lainnya){
            return view('datatable._action2', [
                'model'=> $Lainnya,
                'form_url'=> route('Lainnya.destroy', $Lainnya->id),
                'edit_url'=> route('Lainnya.edit', $Lainnya->id),
                'confirm_message' => 'Yakin mau menghapus ' . $Lainnya->nama_Lainnya . '?'
                ]);
        })->make(true);
    }

    $html = $htmlBuilder
    
    
    ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
    return view('Lainnya.index')->with(compact('Lainnya','html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           $Lainnya = Lainnya::find($id);
        return view('Lainnya.edit')->with(compact('Lainnya'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
    {
        $poto = Lainnya::find($id);
        $poto->update($request->all());
        if ($request->hasFile('cover','cover2')) {
// menambil cover yang diupload berikut ekstensinya
            $filename = null;
            $uploaded_cover = $request->file('cover');
            $uploaded_cover2 = $request->file('cover2');
// mengambil extension file
            $extension = $uploaded_cover->getClientOriginalExtension();
            $extension2 = $uploaded_cover2->getClientOriginalExtension();
// membuat nama file random dengan extension
            $filename = md5(time()) . '.' . $extension;
            $filename2 = md5(time()) . '.' . $extension2;
// menyimpan cover ke folder public/img
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img/img1';
            $destinationPath2 = public_path() . DIRECTORY_SEPARATOR . 'img/img2';
// memindahkan file ke folder public/img
            $uploaded_cover->move($destinationPath, $filename);
            $uploaded_cover2->move($destinationPath2, $filename2);
// hapus cover lama, jika ada
            if ($poto->cover) {
                $old_cover = $poto->cover;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img/img1'
                . DIRECTORY_SEPARATOR . $poto->cover;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
// File sudah dihapus/tidak ada
                }
            }
            if ($poto->cover2) {
                $old_cover = $poto->cover2;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img/img2'
                . DIRECTORY_SEPARATOR . $poto->cover2;
                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
// File sudah dihapus/tidak ada
                }
            }

            // ganti field cover dengan cover yang baru
            $poto->cover = $filename;
            $poto->cover2 = $filename2;
            $poto->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menyimpan Data"
            ]);
        return redirect()->back();
    }
}
