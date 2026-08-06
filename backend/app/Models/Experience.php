<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experience';

    protected $fillable = [
        'role',
        'company',
        'company_url',
        'location',
        'type',
        'description',
        'technologies',
        'start_date',
        'end_date',
        'current',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'current' => 'boolean',
        'sort_order' => 'integer',
        'technologies' => 'array',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * Scope a query to order experiences newest-first.
     *
     * @param  Builder<Experience>  $query
     * @return Builder<Experience>
     */
    public function scopeNewestFirst($query)
    {
        return $query->orderByDesc('start_date');
    }
}
