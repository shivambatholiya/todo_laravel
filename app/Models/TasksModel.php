<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasksModel extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        	'id',	
        	'task_name',
            'status',
        	'created_at',
    ];

}
