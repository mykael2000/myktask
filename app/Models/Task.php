<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'task_id',
        'task_name',
        'task_description',
        'task_deadline',
        'importance',
        'status',
    ];
}