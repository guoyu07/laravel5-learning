<?php

use Illuminate\Database\Seeder;

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->insert([
            'name'        => str_random(10),
            'tag'         => 'tag' . str_random(10),
            'description' => bcrypt('secret'),
        ]);
    }
}

