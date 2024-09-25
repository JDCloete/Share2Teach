<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Analytics
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $user_count
 * @property int $document_count
 * @property int $reported_documents_count
 * @property int $total_download_count
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */

class Analytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_count',
        'document_count',
        'reported_documents_count',
        'total_download_count',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'user_count' => 'integer',
            'document_count' => 'integer',
            'reported_documents_count' => 'integer',
            'total_download_count' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // User HasMany analytics
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
