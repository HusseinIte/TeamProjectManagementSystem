<?php

namespace Database\Seeders;

use App\Enums\RoleUser;
use App\Models\ProjectUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectUser::create([
            'project_id' => 1,
            'user_id' => 2,
            'contribution_hours' => 25,
            'last_activity' => "2024-02-22",
            'role' => RoleUser::Developer
        ]);

        ProjectUser::create([
            'project_id' => 1,
            'user_id' => 3,
            'contribution_hours' => 25,
            'last_activity' => "2024-02-22",
            'role' => RoleUser::Developer

        ]);

        ProjectUser::create([
            'project_id' => 2,
            'user_id' => 2,
            'contribution_hours' => 25,
            'last_activity' => "2024-02-22",
            'role' => RoleUser::Developer
        ]);

        ProjectUser::create([
            'project_id' => 2,
            'user_id' => 3,
            'contribution_hours' => 25,
            'last_activity' => "2024-02-22",
            'role' => RoleUser::Developer
        ]);


        ProjectUser::create([
            'project_id' => 2,
            'user_id' => 2,
            'contribution_hours' => 25,
            'last_activity' => "2024-02-22",
            'role' => RoleUser::Developer
        ]);
    }
}
