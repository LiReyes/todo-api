<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model
{
    use HasFactory, ApiTrait;
    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
    ];

    protected $allowFilter = ['title', 'description', 'status'];
    protected $allowFilterStrict = ['user_id'];
    protected $allowSort = ['title', 'description', 'status'];
    protected $unformatMap = [
        'TaskUser_id' => 'user_id',
        'TaskTitle' => 'title',
        'TaskDescription' => 'description',
        'TaskStatus' => 'status',
    ];
    
}
