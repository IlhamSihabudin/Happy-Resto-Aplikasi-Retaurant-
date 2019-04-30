<?php

namespace App\Http\Controllers;

use App\Masakan;
use Illuminate\Http\Request;

class MasakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masakan = Masakan::all();
        return view('pages.masakan.index', ['masakan'=> $masakan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.masakan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'gambar' => ['mimes:jpg,jpeg,JPEG,png','max:2024'],
        ]);

        $gambar = $request->file('gambar')->getClientOriginalName();
        $destination = base_path() . '/public/assets/img';
        $request->file('gambar')->move($destination, $gambar );

        Masakan::create([
            'nama_masakan'=>$request->nama_masakan,
            'harga'=>$request->harga,
            'jenis_masakan'=>$request->jenis_masakan,
            'gambar' => $gambar,
            'status_masakan'=>$request->status_masakan,
        ]);

        return redirect()->route('masakan')->with('success', 'Input Data Successfully!');
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
    public function edit(Masakan $masakan)
    {
        return view('pages.masakan.edit', ['data'=>$masakan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Masakan $masakan)
    {
        $masakan->update($request->except('_method', '_token'));

        return redirect()->route('masakan')->with('success', 'Update Data Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Masakan $masakan)
    {
        $masakan->delete();
        return back()->with('success', 'Delete Data Successfully');
    }

    public function masakan(Masakan $masakan)
    {
        return json_encode(['code'=>200, 'message'=>'api.masakan', 'data'=>$masakan]);
    }
}
