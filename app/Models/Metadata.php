<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PhpParser\Comment\Doc;

/**
 * App\Models\Metadata
 *
 * @property int $id
 * @property int $document_id
 * @property string $module_code
 * @property string $category
 * @property int $academic_year
 * @property string $lecturer_name
 * @property Carbon $upload_date
 * @property string $type
 * @property int $size
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */

class Metadata extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_id',
        'module_code',
        'category',
        'academic_year',
        'lecturer_name',
        'upload_date',
        'type',
        'size',
    ];

    protected function casts(): array
    {
        return [
            'document_id' => 'integer',
            'academic_year' => 'integer',
            'upload_date' => 'datetime',
            'size' => 'integer',
        ];
    }

    // Metadata BelongsTo one Document
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}




