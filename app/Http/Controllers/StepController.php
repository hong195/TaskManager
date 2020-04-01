<?php

namespace App\Http\Controllers;

use App\Cell;
use App\Enums\CellStatus;
use App\Step;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class StepController extends Controller
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
        $cell = Cell::where('id', $request->cell_id)->first();
        $unit = $cell->block->department->unit;

        if (Gate::denies('manage', $unit)) {
            return redirect(url('/'));
        }

        $request->validate([
            'name' => 'required',
            'person' => 'required',
            'start_date' => 'required',
            'status' => 'required|in:' . implode(',', CellStatus::cellStatuses()),
            'deadline' => 'required'
        ]);

        $step = new Step($request->all());
        $step->save();

        return redirect()->back();
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
     * @param Step $step
     * @param Unit $aa
     * @return void
     */
    public function update(Request $request, Step $step)
    {
        $unit = $step->cell->block->department->unit;

        if (Gate::denies('manage', $unit)) {
            return redirect('/');
        }

        $request->validate([
            'name' => 'required',
            'person' => 'required',
            'start_date' => 'required',
            'status' => 'required|in:' . implode(',', CellStatus::cellStatuses()),
            'deadline' => 'required'
        ]);

        $step->update($request->all());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Step $step
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Step $step)
    {
        $unit = $step->cell->block->department->unit;

        if (Gate::denies('manage', $unit)) {
            return redirect('/');
        }
        $step->delete();

        return redirect()->back();
    }
}
