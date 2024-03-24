<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable implements FilamentUser, HasName, HasAvatar
{
    use HasFactory;

    protected $table = 'employee';

    protected $fillable = [
        'is_active',
        'account',
        'password',
        'name',
        'avatar'
    ];
    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $hidden = [
        'password'
    ];
    public function canAccessPanel(Panel $panel): bool
    {
        // TODO: Implement canAccessPanel() method.
        return $this->is_active;
    }

    public function getFilamentName(): string
    {
        // TODO: Implement getFilamentName() method.
        return $this->name;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        // TODO: Implement getFilamentAvatarUrl() method.
        return $this->avatar;
    }
}
