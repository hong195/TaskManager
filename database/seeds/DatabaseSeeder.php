<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(UnitTableSeeder::class);
        $this->call(FileTableSeeder::class);
        $this->call(SectionTableSeeder::class);
        $this->call(BlockTableSeeder::class);
        $this->call(CellsTableSeeder::class);
        $this->call(StepsTableSeeder::class);
        $this->call(UnitSectionTableSeeder::class);
        $this->call(TermTableSeeder::class);

    }
}
