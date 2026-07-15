<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'username', 'avatar'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the tasks owned by this user.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'user_id', 'id');
    }

    /**
     * Get the sprints owned by this user.
     */
    public function sprints(): HasMany
    {
        return $this->hasMany(Sprint::class);
    }

    public function avatarUrl(): Attribute
    {
        return new Attribute(
            get: fn () => $this->avatar ? asset('storage/'.$this->avatar) : asset('images/avatars/blank.png')
        );
    }
}
