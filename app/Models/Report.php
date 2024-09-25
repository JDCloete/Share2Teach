<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Report
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $document_id
 * @property string $report_reason
 * @property string|null $report_description
 * @property int|null $moderator_id
 * @property string|null $action_taken
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */

class Report extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'document_id',
        'report_reason',
        'report_description',
        'moderator_id',
        'action_taken',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'document_id' => 'integer',
            'moderator_id' => 'integer',
            'action_taken' => 'string',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }



    /**
     * Get the user that owns the report.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the document that is being reported.
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    /**
     * Get the moderator that handled the report.
     */
    public function moderator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'moderator_id');
    }
}
