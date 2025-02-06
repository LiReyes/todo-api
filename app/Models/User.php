<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\ApiTrait;

class User extends Model
{
    use HasFactory, ApiTrait;
    protected $table = 'users';
    protected $fillable = [
        'username',
        'password',
        'email',
    ];
    protected $allowFilter = ['username', 'email'];
    protected $allowSort = ['username', 'email'];
    protected $unformatMap = [
        'UserUsername' => 'username',
        'UserEmail' => 'email',
    ];
}
