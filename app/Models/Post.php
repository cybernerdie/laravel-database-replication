<?php

namespace App\Models;

use App\Traits\ConnectionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use ConnectionTrait;
    use HasFactory;

    protected $guarded = ['id'];
}
