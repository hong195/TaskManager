<?php

namespace App\Http\Controllers;

use App\Block;
use App\Enums\CellStatus;
use Illuminate\Http\Request;

class BlockRelationController extends Controller
{
    public function cells(Block $block)
    {
        $department = $block->department->load('blocks.cells');
        $unit = $block->unit();
        $active_block = $block->id;
        $cell_statuses = CellStatus::cellStatuses();

        return view('relation.block_cells', compact('block', 'department', 'unit', 'active_block', 'cell_statuses'));
    }
}
