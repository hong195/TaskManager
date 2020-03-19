<?php

use App\Unit;
use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $string = ['Asklepiy', 'Nika Pharm', 'Oxymed', 'Excellent Customs', 'Zamona Rano', 'Mari pharm'];
        foreach($string as $one){
            factory(Unit::class)->create([
                'name' => $one,
            ]);
        }
    }
}
