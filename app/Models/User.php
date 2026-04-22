<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 
        'login_attempts', 'blocked_until', 'municipio'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'blocked_until' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    public function isBlocked(): bool
    {
        if (!$this->blocked_until) {
            return false;
        }
        return $this->blocked_until->isFuture();
    }

    public function incrementLoginAttempts(): void
    {
        $this->login_attempts++;
        
        if ($this->login_attempts >= 3) {
            $this->blocked_until = now()->addMinutes(5);
        }
        
        $this->save();
    }

    public function resetLoginAttempts(): void
    {
        $this->login_attempts = 0;
        $this->blocked_until = null;
        $this->save();
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function getBlockedTimeRemaining(): ?string
    {
        if ($this->isBlocked()) {
            $minutes = now()->diffInMinutes($this->blocked_until);
            return "{$minutes} minutos";
        }
        return null;
    }
}