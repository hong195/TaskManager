<?php

use Illuminate\Database\Seeder;

class TermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = \App\Unit::all()->pluck('id');
        $arrayOfTypes = ['Миссия', 'Виденье', 'Ценности'];

        foreach ($units as $oneUnit) {
            foreach ($arrayOfTypes as $oneType) {
                factory(\App\Term::class)->create([
                    'bu_id' => $oneUnit,
                    'type' => $oneType
                ]);
            }
        }
        //TODO make more simple
        $terms = \App\Term::all()->pluck('id');
        foreach ($terms as $oneTerm) {
            \Illuminate\Support\Facades\DB::table('files')->insert([
                'name' => 'mission',
                'source' => '/terms_img/mission.png',
                'extension' => 'png',
                'size' => 111,
                'term_id' => $oneTerm
            ]);
        }

    }
}
