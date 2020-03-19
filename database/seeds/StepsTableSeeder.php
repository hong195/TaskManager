<?php

use App\Cell;
use App\Step;
use Illuminate\Database\Seeder;

class StepsTableSeeder extends Seeder
{
    public function run()
    {

        $cell = Cell::first()->id;
        for ($i = 0; $i < 4; $i++) {
            factory(Step::class)->create([
                'cell_id' => $cell,
            ]);
        }
    }
}
