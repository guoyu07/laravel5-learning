<?php

use App\Models\Todo;
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
        $todos = factory(Todo::class)->times(300)->make();
        Todo::insert($todos->toArray());
    }
}

