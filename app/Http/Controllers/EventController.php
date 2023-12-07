<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = Event::latest()->get();
        return view('admin.event.index', compact('event'));
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
            'title' => 'required',
        ],[
            'title' => 'Insert deksripsi',
            'foto' => 'Insert Image',
            'foto.mimes' => 'Image Must Be jpeg, jpg, png, webp',
        ]);
        try{
            $newEvent = new Event();
            $newEvent->title = $request->title;
            if($request->hasFile('foto'))
            {
                $fotoEvent = 'Event'.rand(1,99999).'.'.$request->foto->getClientOriginalExtension();
                $request->file('foto')->move(public_path().'/image/', $fotoEvent);
                $newEvent->foto = $fotoEvent;
                $newEvent->save();
            }
            $newEvent->save();
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
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try{
            $editEvent = Event::find($id);
            $editEvent->title = $request->title;
            if($request->hasFile('foto'))
            {
                $fotoEvent = 'Event'.rand(1,99999).'.'.$request->foto->getClientOriginalExtension();
                $request->file('foto')->move(public_path().'/image/', $fotoEvent);
                $editEvent->foto = $fotoEvent;
                $editEvent->save();
            }
            $editEvent->save();
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
        $event = Event::find($id);
        File::delete('image/'.$event->foto);
        $event->delete();

        return redirect()->back();
    }
}
