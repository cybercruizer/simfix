<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $connection = 'second_db';
    protected $fillable=[
        'student_id',
        'student_name',
        'student_number',
        'class_id',
    ];
    /**
     * Get the classroom associated with the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function classroom(): HasOne
    {
        return $this->hasOne(Classroom::class, 'class_id', 'class_id');
    }
    /**
     * Get all of the presensi for the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function presensis(): HasMany
    {
        return $this->hasMany(Presensi::class,'student_id','student_id');
    }
}
