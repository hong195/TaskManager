<?php

namespace App\Http\Controllers;

use App\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $terms = Term::where('bu_id', $request->unitId)->get();
        return view('terms.index', compact('terms'));
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
        //
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
        $term = Term::where('id', $id)->firstOrFail();
        return view('terms.edit', compact('term'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Term $term
     * @return void
     */
    public function update(Request $request, Term $term)
    {
        if (Gate::denies('manage')) {
            return redirect(url('/'));
        }

        $request->validate([
            'text' => 'required',
        ]);

        if ($request->hasFile('term_image')) {
            $file = $request->file('term_image');
            $fileName =  $file->getFilename().'.' .$file->getClientOriginalExtension();
            $file->storeAs('/public/terms_img',  $fileName);
            $term->file->source = 'terms_img/' . $fileName;
            $term->file->save();
        }

        $term->text = $request->text;
        $term->save();

        return redirect(route('units.show', $term->bu_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Term $term
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Term $term)
    {
        //
    }
}
