<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $connection = 'second_db';
    protected $guarded=[];

    public function scopeGuru($query,$role)
    {
        return $query->where('role',$role);
    }
}
