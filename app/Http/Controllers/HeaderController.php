<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $header = Header::latest()->get();
        return view('admin.header.index', compact('header'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'foto' => 'required|file|mimes:jpeg,jpg,png,webp',
        ],[
            'foto' => 'Insert Image',
            'foto.mimes' => 'Image Must Be jpeg, jpg, png, webp',
        ]);
        try{
            $newHeader = new Header();
            $fotoHeader = 'Header'.rand(1,99999).'.'.$request->foto->getClientOriginalExtension();
            $request->file('foto')->move(public_path().'/image/', $fotoHeader);
            $newHeader->foto = $fotoHeader;
            $newHeader->save();
            Alert::success('Success', 'Data Created Successfully');
            return redirect()->back();
        }catch (Throwable $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
          
          }
    }

    /**
     * Display the specified resource.
     */
    public function show(Header $header)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Header $header)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $newHeader = Header::find($id);
            $fotoHeader = 'Header'.rand(1,99999).'.'.$request->foto->getClientOriginalExtension();
            $request->file('foto')->move(public_path().'/image/', $fotoHeader);
            $newHeader->foto = $fotoHeader;
            $newHeader->save();
            Alert::success('Success', 'Data Updated Successfully');
            return redirect()->back();
        }catch (Throwable $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
          
          }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $header = Header::find($id);
        File::delete('image/'.$header->foto);
        $header->delete();

        return redirect()->back();
    }
}
