<?php

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder {

    public function run()
    {
        $tasks = factory(Task::class)->times(123)->make();
        Task::insert($tasks->toArray());
    }

}