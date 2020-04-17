<?php

namespace App\Http\Controllers;

use App\Block;
use App\Cell;
use App\Department;
use App\Enums\CellStatus;
use App\File;
use App\Section;
use App\Unit;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RelationController extends Controller
{

    public function unitRelation(Unit $unit)
    {
        return view('relation.unit_department', ['unit' => $unit ?? []]);
    }

    public function ajaxblocks(Request $request)
    {
        return view('ajax', ['blocks' => Block::where('dep_id', $request->id)->get()]);
    }

    public function getDataBySection(Request $request)
    {
        $unit = Unit::where('id', $request->unitId)->first();
        $section = Section::where('id', $request->sectionId)->first();

        return view('ajax.photobooth', [
            'file' => $section->file,
            'section_id' => $request->sectionId,
            'unit_id' => $request->unitId,
            'unit' => $unit
        ]);
    }

    public function ajaxphotobooth()
    {
        return view('ajax.photobooth');
    }

    public function depRelation(Department $department)
    {
        $unit = Unit::where('id', $department->bu_id)->first();
        $active_dep = $department->id;
        return view('relation.department_blocks',
            [
                'department' => $department, 'unit' => $unit, 'active_dep' => $active_dep
            ]);
    }

    public function blockRelation(Block $block)
    {
        $department = Department::where('id', $block->dep_id)->first();
        $unit = Unit::where('id', $department->bu_id)->first();
        $active_block = $block->id;
        $cell_statuses = CellStatus::cellStatuses();

        return view('relation.block_cells', compact('block', 'department', 'unit', 'active_block', 'cell_statuses'));
    }

    public function cellRelation(Cell $cell)
    {
        $block = Block::where('id', $cell->block_id)->first();
        $department = Department::where('id', $block->dep_id)->first();
        $unit = Unit::where('id', $department->bu_id)->first();
        $cell_statuses = CellStatus::cellStatuses();
        $active_cell = $cell->id;

        return view('relation.cell_steps',
            compact('cell', 'block', 'department', 'unit', 'cell_statuses', 'active_cell')
        );
    }

    public function getCellsBySystemGC()
    {
        return [
            'asklepiy' => [
                'hr' => [
                    'in progress' => [
                        'plan' => 47,
                        'fact' => 1
                    ],
                    'done' => [
                        'plan' => 1,
                        'fact' => 0
                    ]
                ],
                'financial' => [
                    'in progress' => [
                        'plan' => 41,
                        'fact' => 1
                    ],
                    'done' => [
                        'plan' => 1,
                        'fact' => 0
                    ]
                ],
                'marketing' => [
                    'in progress' => [
                        'plan' => 45,
                        'fact' => 1
                    ],
                    'done' => [
                        'plan' => 1,
                        'fact' => 0
                    ]
                ],
                'CMD' => [
                    'in progress' => [
                        'plan' => 0,
                        'fact' => 0
                    ],
                    'done' => [
                        'plan' => 0,
                        'fact' => 0
                    ]
                ],
                'Logistics' => [
                    'in progress' => [
                        'plan' => 0,
                        'fact' => 0
                    ],
                    'done' => [
                        'plan' => 0,
                        'fact' => 0
                    ]
                ],
                'Law' => [
                    'in progress' => [
                        'plan' => 42,
                        'fact' => 1
                    ],
                    'done' => [
                        'plan' => 1,
                        'fact' => 0
                    ]
                ],
                'IT' => [
                    'in progress' => [
                        'plan' => 50,
                        'fact' => 0
                    ],
                    'done' => [
                        'plan' => 0,
                        'fact' => 0
                    ]
                ],
                'PR' => [
                    'in progress' => [
                        'plan' => 25,
                        'fact' => 1
                    ],
                    'done' => [
                        'plan' => 1,
                        'fact' => 0
                    ]
                ],
                'Summary' => [
                    'in progress' => [
                        'plan' => 250,
                        'fact' => 5
                    ],
                    'done' => [
                        'plan' => 5,
                        'fact' => 0
                    ]
                ],
            ],
            'asklepiy_group' => [
                'hr' => [
                    'in progress' => [
                        'plan' => 235,
                        'fact' => 5
                    ],
                    'done' => [
                        'plan' => 5,
                        'fact' => 0
                    ]
                ],
                'financial' => [
                    'in progress' => [
                        'plan' => 205,
                        'fact' => 5
                    ],
                    'done' => [
                        'plan' => 5,
                        'fact' => 0
                    ]
                ],
                'marketing' => [
                    'in progress' => [
                        'plan' => 225,
                        'fact' => 5
                    ],
                    'done' => [
                        'plan' => 5,
                        'fact' => 0
                    ]
                ],
                'CMD' => [
                    'in progress' => [
                        'plan' => 0,
                        'fact' => 0
                    ],
                    'done' => [
                        'plan' => 0,
                        'fact' => 0
                    ]
                ],
                'Logistics' => [
                    'in progress' => [
                        'plan' => 0,
                        'fact' => 0
                    ],
                    'done' => [
                        'plan' => 0,
                        'fact' => 0
                    ]
                ],
                'Law' => [
                    'in progress' => [
                        'plan' => 210,
                        'fact' => 5
                    ],
                    'done' => [
                        'plan' => 1,
                        'fact' => 0
                    ]
                ],
                'IT' => [
                    'in progress' => [
                        'plan' => 50,
                        'fact' => 0
                    ],
                    'done' => [
                        'plan' => 0,
                        'fact' => 0
                    ]
                ],
                'PR' => [
                    'in progress' => [
                        'plan' => 25,
                        'fact' => 1
                    ],
                    'done' => [
                        'plan' => 1,
                        'fact' => 0
                    ]
                ],
                'Summary' => [
                    'in progress' => [
                        'plan' => 250,
                        'fact' => 5
                    ],
                    'done' => [
                        'plan' => 5,
                        'fact' => 0
                    ]
                ],
            ]
        ];
    }

    public function getDataForAnalytics2()
    {
        return [
            'april' => [
                'asklepiy' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0
                ],
                'oxymed' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 25,
                    'fact' => 0,
                    'complete' => 0
                ],
            ],
            'may' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
            ],
            'june' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
            ],
            'july' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
            ],
            'august' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
            ],
            'september' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
            ],
            'october' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
            ],
            'december' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
            ],
        ];
    }

    public function getDataForAnalytics3(Unit $unit)
    {
        //TODO make unit data
        return [
            'asklepiy' => [
                'april' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0
                ],
                'may' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'june' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'july' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'august' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'september' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'october' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'november' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
                'december' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0
                ],
            ]
        ];

    }

    public function test()
    {

//        $allHrCells = Cell::query()->where('block_id', '<', 11)->count();
//        dd($allHrCells);
//        $allFinancialCells = Cell::where([['block_id', '>=', 11], ['block_id', '<=',  18]])->count();
//        dd($allFinancialCells);
//        $allMarketing = Cell::where([['block_id', '>=', 19], ['block_id', '<=',  28]])->count();
//        dd($allMarketing);
//            $allIt = Cell::where([['block_id', '>=', 29], ['block_id', '<=',  37]])->count();
//            dd($allIt);
//            $allLaw = Cell::where([['block_id', '>=', 38], ['block_id', '<=',  47]])->count();
//            dd($allLaw);
//        $PR = Cell::where([['block_id', '>=', 48], ['block_id', '<=',  54]])->count();
//        dd($PR);
//        $transportCells = Cell::where([['block_id', '>=', 55], ['block_id', '<=',  59]])->count();
//        dd($transportCells);
//        $CMDcells = Cell::where([['block_id', '>=', 60], ['block_id', '<=',  63]])->count();
//        dd($CMDcells);
//        $finalized = Cell::where('status','complete')->get();
//        dd($finalized);


    }


//    public function getUnitCellsCount($id)
//    {
//
//        $emptyArr = [];
//        $unitCells = Unit::find($id)->cells->groupBy(function ($val) {
//            return Carbon::parse($val->created_at)->format('M:Y');
//        });
//        foreach ($unitCells as $key => $oneMonth) {
//            $emptyArr[$key] = count($oneMonth);
//        }
//        return $emptyArr;
//    }
//
//    protected function getHRIds()
//    {
//        return [1, 9, 17, 25, 33, 41, 49];
//    }
//
//    protected function getFinancialIds()
//    {
//        return [2, 10, 18, 26, 34, 42, 50];
//    }
//
//    protected function getMarketingIds()
//    {
//        return [3, 11, 19, 27, 35, 43, 51];
//    }
//
//    protected function getItIds()
//    {
//        return [4, 12, 20, 28, 36, 44];
//    }
//
//    protected function getLawIds()
//    {
//        return [5, 13, 21, 29, 37, 45, 53];
//    }
//
//    protected function getPRIds()
//    {
//        return [6, 14, 22, 30, 38, 46, 54];
//    }
//
//    protected function getLogistics()
//    {
//        return [7, 15, 23, 31, 39, 47, 55];
//    }
//
//    protected function getCatManIds()
//    {
//        return [8, 16, 24, 32, 40, 48, 56];
//    }
//
//    public function getAsklepiyCells()
//    {
//        $unit = Unit::find(3)->departments;
//        return $unit;
//    }
}
