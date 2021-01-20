<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'description'
    ];

    public function users(): ?BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_news')
            ->withPivot('ip', 'created_at');
    }

    public function newsView(): ?HasMany
    {
        return $this->hasMany(NewsView::class, 'news_id', 'id');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters): ?Builder
    {
        return $filters->apply($builder);
    }
}
