<?php

declare(strict_types = 1);

namespace App\Services\Converter\Processors;

use App\Models\File as FileModel;

/**
 * Interface ProcessorInterface
 */
interface ProcessorInterface
{
    public const TYPE_IMAGE = 'Image';

    /**
     * @param FileModel $fileModel
     *
     * @return void
     */
    public function convert(FileModel $fileModel): void;
}
