<?php

namespace App\Http\Controllers;

use App\Unit;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $units = Unit::all();
        return view('units', ['units' => $units]);
    }

    /**
     * Display the specified resource.
     *
     * @param Unit $unit
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Unit $unit)
    {
        return view('units.unit', [
            'unit' => $unit,
            'sections' => $unit->sections,
            'active_section' => $unit->sections->first()->id,
        ]);
    }

}
