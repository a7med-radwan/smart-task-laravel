<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'is_completed',
        'due_date',
        'due_time',
        'priority',
        'sprint_id',
        'story_points',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sprint(): BelongsTo
    {
        return $this->belongsTo(Sprint::class);
    }

    public function description(): Attribute
    {
        return new Attribute(
            set: fn($value) => strip_tags($value, '<h2><h3><h4><h5><h6><p><a><ul><ol><li><br><strong><em><img><video><audio>'),
        );
    }

    public function title(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucwords($value),
            set: fn($value) => strip_tags($value),
        );
    }

}
