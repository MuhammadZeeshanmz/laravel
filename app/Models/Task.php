<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
    'title', 'description', 'assigned_at', 'created_by'
];

  public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function assignedUsers() {
        return $this->belongsToMany(User::class, 'task_user');
    }
}


