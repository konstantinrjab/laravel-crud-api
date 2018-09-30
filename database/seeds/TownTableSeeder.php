<?php

use Illuminate\Database\Seeder;
use App\Town;

class TownTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['London', 'New York', 'Sidney', 'Ankara', 'Tokio'];
        foreach ($names as $name){
            Town::create([
                'name' => $name
            ]);
        }
    }
}
