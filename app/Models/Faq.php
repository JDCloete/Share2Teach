<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Faq
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $faq_question
 * @property string|null $faq_answer
 * @property Carbon $faq_date_created
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Faq extends Model
{
    use HasFactory;

    protected $table = 'faq';

    protected $fillable = [
        'user_id',
        'faq_question',
        'faq_answer',
        'faq_date_created',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'faq_date_created' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    // Faq belongsTo User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
