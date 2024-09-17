<?php

namespace Database\Seeders;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Task::create([
        'project_user_id'=>1,
        'title'=>"task1",
        'due_date'=>"2024-02-23",
        'work_hours'=>25,
        'description'=>"nothing"
       ]);

       Task::create([
        'project_user_id'=>1,
        'title'=>"task2",
        'due_date'=>"2024-02-23",
        'work_hours'=>25,
        'description'=>"nothing"
       ]);

       Task::create([
        'project_user_id'=>1,
        'title'=>"task3",
        'due_date'=>"2024-02-23",
        'work_hours'=>25,
        'description'=>"nothing"
       ]);

       Task::create([
        'project_user_id'=>3,
        'title'=>"task4",
        'due_date'=>"2024-02-23",
        'work_hours'=>25,
        'description'=>"nothing"
       ]);

       Task::create([
        'project_user_id'=>2,
        'title'=>"task5",
        'due_date'=>"2024-02-23",
        'work_hours'=>25,
        'description'=>"nothing"
       ]);
    }
}
