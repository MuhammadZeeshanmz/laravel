<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    //
    use HasApiTokens;
    protected $fillable = [
        'first_name',
        'last_name',
        'password',
        'dob',
        'phone_number',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'created_by');
    }
    
    public function assignedTasks(){
        return $this->belongsToMany(Task::class, 'task_user');
    }
    
}
