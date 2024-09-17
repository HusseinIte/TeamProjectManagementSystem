<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('id', 'role', 'contribution_hours', 'last_activity')
            ->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasManyThrough(
            Task::class,
            ProjectUser::class,
            'project_id',
            'project_user_id',
            'id',
            'id'
        );
    }

    public function oldestTask()
    {
        return $this->tasks()->oldest('created_at')->first();
    }

    public function latestTask()
    {
        return $this->tasks()->latest('created_at')->first();
    }

    public function HighPriorityTask()
    {
        return $this->tasks()  ->where('priority', 'High')
        ->where('title', 'like', '%user%')
        ->get();
    }

}
