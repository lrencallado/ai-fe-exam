<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'link',
        'content',
        'status',
        'writer',
        'editor',
        'company',
        'date',
    ];

    protected $with = [
        'writer',
        'editor',
    ];

    public function writer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'writer');
    }

    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'editor');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company');
    }
}
