<?php

use App\Block;
use App\Unit;
use Illuminate\Database\Seeder;

class BlockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Block::class)->create([
            'section_id' => \App\Section::first()->id,
        ]);
    }
}
