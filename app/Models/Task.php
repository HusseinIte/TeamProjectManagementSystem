<?php

namespace App\Models;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_user_id',
        'title',
        'status',
        'priority',
        'work_hours',
        'description',
        'note'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => TaskStatus::class,
            'priority' => TaskPriority::class
        ];
    }

    protected static function boot()
    {
        parent::boot();
        static::updating(function($task){
            if ($task->isDirty('status') && $task->status == TaskStatus::COMPLETED) {
                $task->due_date=now();
            }
        });
        static::updated(function ($task) {
            if ($task->isDirty('status') && $task->status == TaskStatus::COMPLETED) {
                $task->projectUser->contribution_hours +=$task->work_hours;
            }
            $task->projectUser->last_activity=$task->updated_at;
            $task->projectUser->save();
        });
    }

    public function projectUser()
    {
        return $this->belongsTo(ProjectUser::class);
    }

}
