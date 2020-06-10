<?php

namespace App\Http\Controllers;

use App\Cell;
use App\Enums\CellStatus;
use App\File;
use App\Traits\DateTrait;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CellController extends Controller
{
    /**
     * Update the specified cell in storage.
     *
     * @param Request $request
     * @param Cell $cell
     * @return RedirectResponse
     */
    public function update(Request $request, Cell $cell)
    {
        $validatedCellAttributes = $this->validateCellAttributes($request);

        if ($request->status === CellStatus::IN_PROGRESS) {
            $validatedCellAttributes['fact_start_date'] = Carbon::parse(now())->format('Y-m-d');
        }else if ($request->status === CellStatus::COMPLETE) {
            $validatedCellAttributes['fact_deadline'] = Carbon::parse(now())->format('Y-m-d');
        }

        $cell->update($validatedCellAttributes);

        // Todo move to File Model
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


        return redirect()->back();
    }

    public function validateCellAttributes(Request $request)
    {
        return  $request->validate([
            'name' => 'required',
            'visualisation_date' => 'nullable',
            'plan_deadline' => 'nullable',
            'status' => 'required|in:' . implode(',', CellStatus::cellStatuses()),
        ]);
    }
}
