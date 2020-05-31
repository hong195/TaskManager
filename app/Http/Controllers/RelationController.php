<?php

namespace App\Http\Controllers;

use App\Block;
use App\Cell;
use App\Department;
use App\Enums\CellStatus;
use App\File;
use App\Http\Contracts\GanttAnalitycsContract;
use App\Section;
use App\Step;
use App\Unit;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function foo\func;

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
        $companies = ['ASKLEPIY', 'ASKLEPIY Group', 'Oxymed', 'NIKA PHARM', 'ZAMONA RANO', 'MARI PHARM'];
        $data = [];

        foreach ($companies as $company) {
            if ($company == 'ASKLEPIY') {
                $data[$company] = [
                    'HR' => [
                        'in progress' => [
                            'plan' => 47,
                            'fact' => 1
                        ],
                        'done' => [
                            'plan' => 1,
                            'fact' => 0
                        ]
                    ],
                    'Financial' => [
                        'in progress' => [
                            'plan' => 41,
                            'fact' => 1
                        ],
                        'done' => [
                            'plan' => 1,
                            'fact' => 0
                        ]
                    ],
                    'Marketing' => [
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
                ];
            } else {
                $data[$company] = [
                    'HR' => [
                        'in progress' => [
                            'plan' => 25,
                            'fact' => 5
                        ],
                        'done' => [
                            'plan' => 5,
                            'fact' => 0
                        ]
                    ],
                    'Financial' => [
                        'in progress' => [
                            'plan' => 25,
                            'fact' => 5
                        ],
                        'done' => [
                            'plan' => 5,
                            'fact' => 0
                        ]
                    ],
                    'Marketing' => [
                        'in progress' => [
                            'plan' => 25,
                            'fact' => 5
                        ],
                        'done' => [
                            'plan' => 5,
                            'fact' => 0
                        ]
                    ],
                    'CMD' => [
                        'in progress' => [
                            'plan' => 40,
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
                            'plan' => 25,
                            'fact' => 15
                        ],
                        'done' => [
                            'plan' => 15,
                            'fact' => 0
                        ]
                    ],
                    'IT' => [
                        'in progress' => [
                            'plan' => 25,
                            'fact' => 15
                        ],
                        'done' => [
                            'plan' => 15,
                            'fact' => 0
                        ]
                    ],
                    'PR' => [
                        'in progress' => [
                            'plan' => 25,
                            'fact' => 15
                        ],
                        'done' => [
                            'plan' => 15,
                            'fact' => 0
                        ]
                    ],
                    'Summary' => [
                        'in progress' => [
                            'plan' => 235,
                            'fact' => 5
                        ],
                        'done' => [
                            'plan' => 5,
                            'fact' => 0
                        ]
                    ],
                ];
            }
        }

        return $data;
    }

    public function getDataForAnalytics2()
    {
        return [
            'april' => [
                'asklepiy' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'oxymed' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 25,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'may' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'june' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'july' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'august' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'september' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'october' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'december' => [
                'asklepiy' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'oxymed' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'nika_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'zamona_rano' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'mari_pharm' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'asklepiy_group' => [
                    'in_progress' => 0,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
        ];
    }

    public function getDataForAnalytics3()
    {
        //TODO make unit data
        return [
            'april' => [
                'HR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Financial' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Marketing' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'CMD' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Logistics' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Law' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'IT' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'PR' => [
                    'in_progress' => 1,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'may' => [
                'HR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Financial' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Marketing' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'CMD' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Logistics' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Law' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'IT' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'PR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'june' => [
                'HR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Financial' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Marketing' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'CMD' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Logistics' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Law' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'IT' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'PR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'july' => [
                'HR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Financial' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0
                ],
                'Marketing' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'CMD' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Logistics' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Law' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'IT' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'PR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'august' => [
                'HR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Financial' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Marketing' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'CMD' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Logistics' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Law' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'IT' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'PR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'september' => [
                'HR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Financial' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Marketing' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'CMD' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Logistics' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Law' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'IT' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'PR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'october' => [
                'HR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Financial' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Marketing' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'CMD' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Logistics' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Law' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'IT' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'PR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'november' => [
                'HR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Financial' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Marketing' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'CMD' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Logistics' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Law' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'IT' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'PR' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
            'december' => [
                'HR' => [
                    'in_progress' => 10,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Financial' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Marketing' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'CMD' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Logistics' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'Law' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'IT' => [
                    'in_progress' => 5,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
                'PR' => [
                    'in_progress' => 15,
                    'fact' => 0,
                    'complete' => 0,
                    'complete_fact' => 0
                ],
            ],
        ];
    }

    public function statistics(Unit $unit)
    {
        $totalStat = $this->getCellsBySystemGC();
        $companyStat = $this->getDataForAnalytics2();
        $companyDepStat = $this->getDataForAnalytics3();

        $companies = [
            'asklepiy' => 'ASKLEPIY',
            'asklepiy_group' => 'ASKLEPIY Group',
            'oxymed' => 'Oxymed',
            'nika_pharm' => 'NIKA PHARM',
            'zamona_rano' => 'ZAMONA RANO',
            'mari_pharm' => 'MARI PHARM'
        ];
        $departments = [];

        foreach ($totalStat as $company => $dep) {
            $departments = array_keys($dep);
            break;
        }

        return view('relation.statistics',
            compact(
                'unit', 'totalStat', 'companyStat', 'departments', 'companies', 'companyDepStat'
            )
        );
    }

}
