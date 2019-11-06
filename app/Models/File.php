<?php

declare(strict_types = 1);

namespace App\Models;

/**
 * Class File
 *
 * @package App
 */
class File extends \Eloquent
{
    /**
     * @var array
     */
    protected $fillable = [
        'original_name',
        'original_extension',
        'hashed_name',
        'is_converted',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'original_name'      => 'string',
        'original_extension' => 'string',
        'hashed_name'        => 'string',
    ];
}
