<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Produk;
use Validator;
use Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produk = Produk::paginate(5);
        $kategori = Kategori::all();
        $filterKeyword = $request->get('keyword');
        $nama_kategori ='';

        if($filterKeyword)
        {
            //dijalankan jika ada pencarian
            $produk = Produk::where('nama_produk','LIKE',"%$filterKeyword%")->paginate(5);
        }

        $filter_by_kategori = $request->get('kd_kategori');
        if($filter_by_kategori){
            $produk = Produk::where('kd_kategori',$filter_by_kategori)->paginate(5);

            $data_kategori = Kategori::find($filter_by_kategori);
            $nama_kategori = $data_kategori->kategori;
        }

        return view('produk.index',compact('produk','kategori','nama_kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('produk.create',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input,[
            'nama_produk'=>'required|max:255',
            'kd_kategori'=>'required',
            'harga'=>'required|numeric',
            'gambar_produk'=>'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->route('produk.create')->withErrors($validator)->withInput();
        }

        

        if($request->file('gambar_produk')->isValid()){
            $gambar_produk = $request->file('gambar_produk');
            $extention = $gambar_produk->getClientOriginalExtension();
            $namaFoto = "produk/".date('YmdHis').".".$extention;
            $upload_path = 'uploads/produk';
            $request->file('gambar_produk')->move($upload_path,$namaFoto);
            $input['gambar_produk'] = $namaFoto;
        }

        $input['stok'] = 0;

        Produk::create($input);
        return redirect()->route('produk.index')->with('status','Produk Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::all();
        $produk = Produk::findOrFail($id);
        return view('produk.edit',compact('kategori','produk'));
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
        $produk = Produk::findOrFail($id);

        $input = $request->all();

        $validator = Validator::make($input,[
            'nama_produk'=>'required|max:255',
            'kd_kategori'=>'required',
            'harga'=>'required|numeric',
            'gambar_produk'=>'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if($validator->fails())
        {
            return redirect()->route('produk.edit',[$id])->withErrors($validator);
        }

        if($request->hasFile('gambar_produk')){
            if($request->file('gambar_produk')->isValid())
            {
                Storage::disk('upload')->delete($produk->gambar_produk);

                $gambar_produk = $request->file('gambar_produk');
                $extention = $gambar_produk->getClientOriginalExtension();
                $namaFoto = "produk/".date('YmdHis').".".$extention;
                $upload_path = 'uploads/produk';
                $request->file('gambar_produk')->move($upload_path,$namaFoto);
                $input['gambar_produk'] = $namaFoto;

            }   
        }

        $produk->update($input);
        return redirect()->route('produk.index')->with('status','Produk Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        Storage::disk('upload')->delete($produk->gambar_produk);
        return redirect()->route('produk.index')->with('status','Data Produk Berhasil dihapus');
    }
}
