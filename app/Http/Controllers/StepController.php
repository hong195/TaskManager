<?php

namespace App\Http\Controllers;

use App\Cell;
use App\Enums\CellStatus;
use App\Step;
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
        if (Gate::denies('manage')) {
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

        $this->changeCellStatus($step);

        return redirect(route('cells', $step->cell_id));
    }

    public function changeCellStatus($step) {
        $cell = Cell::where('id', $step->cell_id)->first();

        $all_steps = $cell->steps;

        $completed_counter = 0;

        foreach ($all_steps as $step) {
            if ($step->status === CellStatus::COMPLETE) {
                $completed_counter++;
            }
        }

        if ($completed_counter === count($all_steps)) {
            $cell->status = CellStatus::COMPLETE;
            $cell->save();
        }
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
     * @return void
     */
    public function update(Request $request, Step $step)
    {
        if (Gate::denies('manage')) {
            return redirect(route('cells', $step->cell_id));
        }

        $request->validate([
            'name' => 'required',
            'person' => 'required',
            'start_date' => 'required',
            'status' => 'required|in:' . implode(',', CellStatus::cellStatuses()),
            'deadline' => 'required'
        ]);

        $step->update($request->all());

        $this->changeCellStatus($step);

        return redirect(route('cells', $step->cell_id));
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
        if (Gate::denies('manage')) {
            return redirect(route('cells', $step->cell_id));
        }

        $cell_id = $step->cell_id;
        $step->delete();

        return redirect(route('cells', $cell_id));
    }
}
