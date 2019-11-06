<?php

declare(strict_types = 1);

namespace App\Services\Converter\Processors;

use App\Models\File as FileModel;
use App\Services\Converter\Converter;
use App\Services\Converter\Traits\ConverterStorageTrait;
use Storage;

/**
 * Class ImageProcessor
 *
 * @package App\Services\Converter\Processors
 */
class ImageProcessor implements ProcessorInterface
{
    use ConverterStorageTrait;

    /**
     * @param FileModel $fileModel
     *
     * @return void
     */
    public function convert(FileModel $fileModel): void
    {
        $image = new \Imagick($this->getOriginalFilePath($fileModel));

        $image->setImageFormat(Converter::EXTENSION_PDF);

        Storage::disk(Converter::STORAGE_DISK_CONVERTED)
            ->makeDirectory($fileModel->getKey());

        $image->writeImage($this->getConvertedFilePath($fileModel));
    }
}
