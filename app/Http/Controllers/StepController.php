<?php

namespace App\Http\Controllers;

use App\Cell;
use App\Enums\CellStatus;
use App\Step;
use App\Unit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;


class StepController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $cell = Cell::where('id', $request->cell_id)->first();
        $unit = $cell->block->department->unit;

        if (Gate::denies('manage', $unit)) {
            abort(404);
        }

        Step::create($this->validateStepAttributes($request));

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
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

        $step->update($this->validateStepAttributes($request));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Step $step
     * @return Response
     * @throws Exception
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

    public function validateStepAttributes(Request $request)
    {
        return  $request->validate([
            'name' => 'required',
            'person' => 'required',
            'status' => 'required|in:' . implode(',', CellStatus::cellStatuses()),
            'start_date' => 'required',
            'deadline' => 'required',
            'cell_id' => 'required'
        ]);
    }
}
