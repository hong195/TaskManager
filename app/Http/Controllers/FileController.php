<?php

namespace App\Http\Controllers;

use App\File;
use App\Section;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'section_id' => 'required',
            'section_img' => 'required'
        ]);

        $section = Section::where('id', $request->section_id)->first();
        $file = $request->file('section_img');

        $fileName =  $file->getFilename().'.' .$file->getClientOriginalExtension();
        $file->storeAs('public/sections',  $fileName);

        $attachment = new File;
        $attachment->name = $file->getFilename();
        $attachment->source = '/sections/' . $fileName;
        $attachment->extension = $file->getClientOriginalExtension();
        $attachment->size = $file->getSize();

        $section->file()->save($attachment);

        return redirect(route('units.show', $request->unit_id));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        if ($request->file('section_img')) {
            $this->destroy($id);
            $this->store($request);
        }
        return redirect(route('units.show', $request->unit_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::where('id', $id);
        unlink($file->source);
        $file->delete();
    }
}
