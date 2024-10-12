<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

/**
 * App\Models\Document
 *
 * @property int $id
 * @property string $document_name
 * @property string|null $storage_path
 * @property int|null $user_id
 * @property int|null $moderator_id
 * @property bool $is_reviewed
 * @property float $document_rating_average
 * @property string|null $watermark_info
 * @property string $key
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */

class Document extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'document_name',
        'storage_path',
        'user_id',
        'moderator_id',
        'is_reviewed',
        'document_rating_average',
        'watermark_info',
        'key',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'moderator_id' => 'integer',
            'is_reviewed' => 'boolean',
            'document_rating_average' => 'float',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // A Document BelongsTo Metadata
    public function metadata(): HasOne
    {
        return $this->hasOne(Metadata::class, 'document_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
        //return $this->belongsTo(User::class, 'user_id', 'user_id', 'users');
    }

    public function moderator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'moderator_id', 'user_id', 'users');
    }

    // 5 Bridge Entities
    // Document is_starred by many Users --> BelongsToMany
    public function is_starred(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'starred');
    }

    // Documents is_rated by many Users --> BelongsToMany
    public function is_rated(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ratings');
    }

    // Document is_downloaded by many Users --> BelongsToMany
    public function is_downloaded(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'downloads');
    }

    // Document is_reported by many Users --> BelongsToMany
    public function is_reported(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'reports');
    }

    // Document is_shared by many Users --> BelongsToMany
    public function is_shared(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'shares');
    }
}




