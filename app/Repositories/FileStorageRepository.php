<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Models\File as FileModel;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;
use File;
use Storage;

/**
 * Class FileStorageRepository
 *
 * @package App\Repositories
 */
class FileStorageRepository implements FileStorageRepositoryInterface
{
    /**
     * @var string
     */
    protected $storageType;

    /**
     * @param string $storageType
     */
    public function setStorage(string $storageType): void
    {
        $this->storageType = $storageType;
    }

    /**
     * @param FileModel $fileModel
     * @param UploadedFile $file
     *
     * return void
     */
    public function put(FileModel $fileModel, UploadedFile $file): void
    {
        Storage::disk($this->storageType)->put(
            $fileModel->getKey() .
            '/' .
            $fileModel->getAttribute('hashed_name') .
            '.' .
            $fileModel->getAttribute('original_extension'),
            File::get($file->getPathname())
        );
    }

    /**
     * @param FileModel $file
     * @param string $extension
     *
     * @return StreamedResponse
     */
    public function download(FileModel $file, string $extension): StreamedResponse
    {
        return Storage::disk($this->storageType, $extension)
            ->download(
                $file->getKey() . '/' . $file->getAttribute('hashed_name') . ".{$extension}",
                $file->getAttribute('original_name') . ".{$extension}"
            );
    }
}
