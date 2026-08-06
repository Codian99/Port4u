<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Draft = 'draft';
    case Published = 'published';
    case Archived = 'archived';

    /**
     * Get the statuses allowed in API responses.
     *
     * @return string[]
     */
    public static function publicValues(): array
    {
        return [self::Published->value];
    }
}
