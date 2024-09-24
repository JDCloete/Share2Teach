<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // If your table name is not the plural of your model name,
    // explicitly specify the table name
    protected $table = 'documents';

    // Allow mass assignment for attributes like document_name, total_download_count, etc.
    protected $fillable = [
        'total_download_count',
        // other attributes...
    ];
}
