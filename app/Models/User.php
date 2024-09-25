<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $password
 * @property Carbon|null $email_verified_at
 * @property int|null $role_id
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // User HasMany faqs
    public function faq(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    // User HasMany analytics
    public function analytics(): HasMany
    {
        return $this->hasMany(Analytics::class);
    }

    // User BelongsTo a role
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }


    // 5 Bridge Entities
    // User stars many documents --> BelongsToMany
    public function stars(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, 'starred');
    }

    // User rates many documents --> BelongsToMany
    public function rates(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, 'ratings');
    }

    // User downloads many documents --> BelongsToMany
    public function downloads(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, 'downloads');
    }

    // User reports many documents --> BelongsToMany
    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, 'reports');
    }

    // User shares many documents --> BelongsToMany
    public function shares(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, 'shares');
    }
}



