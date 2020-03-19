<?php

use App\File;
use Illuminate\Database\Seeder;

class FileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $units = \App\Unit::all();
        foreach($units as $one){
            factory(File::class)->create([
                'bu_id' => $one->id,
                'name' => $one->name,
                'source' => "/logo/{$one->name}". '.png',
                'extension'=> 'png',
                'size' => 111
            ]);
        }
    }
}
