<?php

declare(strict_types = 1);

namespace App\Services\Converter\Traits;

use App\Models\File as FileModel;
use App\Services\Converter\Converter;
use function storage_path;

/**
 * Trait ConverterStorageTrait
 *
 * @package App\Services\Converter\Traits
 */
trait ConverterStorageTrait
{
    /**
     * @param FileModel $fileModel
     *
     * @return string
     */
    protected function getOriginalFilePath(FileModel $fileModel): string
    {
        return storage_path('app/public/original/') .
            $fileModel->getKey() .
            '/' .
            $fileModel->getAttributeValue('hashed_name') .
            '.' .
            $fileModel->getAttributeValue('original_extension');
    }

    /**
     * @param FileModel $fileModel
     *
     * @return string
     */
    protected function getConvertedFilePath(FileModel $fileModel): string
    {
        return storage_path('app/public/converted/') .
            $fileModel->getKey() .
            '/' .
            $fileModel->getAttributeValue('hashed_name') .
            '.' .
            Converter::EXTENSION_PDF;
    }
}
