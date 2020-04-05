<?php

namespace App\Http\Controllers;

use App\Cell;
use App\Enums\CellStatus;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CellController extends Controller
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
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
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
     * @param Cell $cell
     * @return void
     */
    public function update(Request $request, Cell $cell)
    {
        $request->validate([
            'name' => 'required',
            'deadline' => 'required',
            'status' => 'required|in:' . implode(',', CellStatus::cellStatuses()),
        ]);

        if($request->hasfile('files')) {
            foreach($request->file('files') as $uploadedFile)
            {
                $fileName =  pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME)
                             . uniqid(). '.' . $uploadedFile->getClientOriginalExtension();
                $uploadedFile->storeAs('/public/files/', $fileName);

                $file = new File;
                $file->name = $uploadedFile->getClientOriginalName();
                $file->source = 'files/'. $fileName;
                $file->size = $uploadedFile->getSize();
                $file->extension = $uploadedFile->getClientOriginalExtension();

                $cell->files()->save($file);
            }
        }

        $cell->update($request->all('name', 'deadline', 'status'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
