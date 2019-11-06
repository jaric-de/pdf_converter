<?php

declare(strict_types = 1);

namespace App\Services\Converter\Processors;

use App\Models\File as FileModel;
use App\Services\Converter\Converter;
use App\Services\Converter\Traits\ConverterStorageTrait;
use App;
use File;
use Storage;
use function nl2br;

/**
 * Class TxtProcessor
 *
 * @package App\Services\Converter\Processors
 */
class TxtProcessor implements ProcessorInterface
{
    use ConverterStorageTrait;

    /**
     * @param FileModel $fileModel
     *
     * @return void
     */
    public function convert(FileModel $fileModel): void
    {
        $txtFileContent = nl2br(File::get($this->getOriginalFilePath($fileModel)));

        $pdf = App::make('dompdf.wrapper');
        Storage::disk(Converter::STORAGE_DISK_CONVERTED)
            ->makeDirectory($fileModel->getKey());

        $pdf->loadHTML($txtFileContent)
            ->save($this->getConvertedFilePath($fileModel));
    }
}
