<?php

declare(strict_types = 1);

namespace App\Services\Converter\Processors;

use App\Models\File as FileModel;
use App\Services\Converter\Converter;
use App\Services\Converter\Traits\ConverterStorageTrait;
use App;
use Storage;

/**
 * Class HtmlProcessor
 *
 * @package App\Services\Converter\Processors
 */
class HtmlProcessor implements ProcessorInterface
{
    use ConverterStorageTrait;

    /**
     * @param FileModel $fileModel
     *
     * @return void
     */
    public function convert(FileModel $fileModel): void
    {
        $pdf = App::make('dompdf.wrapper');

        Storage::disk(Converter::STORAGE_DISK_CONVERTED)
            ->makeDirectory($fileModel->getKey());

        $pdf->loadFile($this->getOriginalFilePath($fileModel))
            ->save($this->getConvertedFilePath($fileModel));
    }
}
