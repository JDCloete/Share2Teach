<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $role_name
 * @property string|null $slug
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'slug',
        'description',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            //'id' => 'integer',
            'role_name' => 'string',
            'slug' => 'string',
            'description' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // Roles HasMany users
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
