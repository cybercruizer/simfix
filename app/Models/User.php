<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Schema\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function getRedirectRoute() {
        return match((string)$this->role) {
            'admin' => 'adm.dashboard',
            'guru' => 'guru.dashboard',
            'bk' => 'bk.dashboard',
            'walikelas' => 'walikelas.dashboard',
            'keuangan' => 'keu.dashboard',
        };
    }
    public function scopeWalikelas($q) {
        return $q->where('role','walikelas');
    }
    public function scopeBk($q) {
        return $q->where('role','bk');
    }
    /**
     * Get the classroom associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function classroom(): HasOne
    {
        return $this->hasOne(Classroom::class, 'walikelas_id', 'id');
    }

}
