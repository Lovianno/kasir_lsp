<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $message = [
            'required' => "Nama Kategori Tidak Boleh Kosong",
            'min' => 'Nama Kategori Minimal :min Karakter',
            'max' => 'Nama Kategori Maksimal :max Karakter',
            'numeric' => 'Nama Kategori Wajib di isi Angka',
            
            
        ];
        $validateData =  $request->validate([
            'name'=>'required|max:25|min:1',
        ], $message);
        
        Category::create($validateData);
        Session::flash('statuscreate', 'Data Berhasil ditambahkan');
        return redirect('/category');

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
        $category = Category::find($id);
        return view('editcategory',compact('category'));
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
        $message = [
            'required' => "Nama Kategori Tidak Boleh Kosong",
            'min' => 'Nama Kategori Minimal :min Karakter',
            'max' => 'Nama Kategori Maksimal :max Karakter',
            'numeric' => 'Nama Kategori Wajib di isi Angka',
            
        ];
        $validateData =  $request->validate([
            'name'=>'required|max:25|min:1',
        ], $message);

        Category::find($id)->update($validateData);

        Session::flash('status', 'Data Berhasil di Update');
        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        Session::flash('status', 'Data Berhasil di Hapus');
        return redirect('/category');
    }
}
