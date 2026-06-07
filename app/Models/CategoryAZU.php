<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

/**
 * Category model representing task groupings.
 *
 * Categories are used to organize tasks into logical groups.
 * Each category can be associated with multiple tasks.
 */
class CategoryAZU extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    protected static function booted(): void
    {
        // Auto-generate slug if not manually provided.//
        static::saving(function (CategoryAZU $category): void {
            if (blank($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Get all tasks linked to this category.
     */
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(TaskAZU::class, 'category_task', 'category_id', 'task_id')->withTimestamps();
    }
}
