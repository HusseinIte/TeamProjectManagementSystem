<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Project::Create([
         'name'=>'OrderManagementSystem',
        'description'=>'manage order'
       ]);

       Project::Create([
        'name'=>'TaskManagementSystem',
       'description'=>'manage task'
      ]);

      Project::Create([
        'name'=>'SchoolManagementSystem',
       'description'=>'manage school'
      ]);
    }
}
