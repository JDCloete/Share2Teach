<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Starred
 *
 * @property int $id
 * @property int $user_id
 * @property int $document_id
 * @property Carbon|null $starred_at
 * @property bool $is_favorite
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Starred extends Model
{
    use HasFactory;
    protected $table = 'starred';

    protected $fillable = [
        'user_id',
        'document_id',
        'starred_at',
        'is_favorite',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'document_id' => 'integer',
            'starred_at' => 'datetime',
            'is_favorite' => 'boolean',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}
