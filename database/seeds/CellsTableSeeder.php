<?php

use App\Block;
use App\Cell;
use Illuminate\Database\Seeder;

class CellsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $block = Block::first()->id;
        for ($i = 0; $i < 3; $i++) {
            factory(Cell::class)->create([
                'block_id' => $block
            ]);
        }
    }
}
