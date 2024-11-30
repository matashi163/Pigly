<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function weightLogs()
    {
        return $this->hasMany(WeightLog::class);
    }

    public function weightTarget()
    {
        return $this->hasOne(WeightTarget::class);
    }
}
