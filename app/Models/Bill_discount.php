<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill_discount extends Model
{
    use HasFactory;
    protected $connection = 'second_db';
    protected $guarded=[];
}
