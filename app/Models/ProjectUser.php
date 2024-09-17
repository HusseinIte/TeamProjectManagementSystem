<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'contribution_hours',
        'last_activity'
    ];

    protected $hidden = [
        'project_id',
        'user_id'
    ];

    protected $table = "project_user";
    public $incrementing = true;

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
