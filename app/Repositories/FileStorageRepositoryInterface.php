<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Models\File as FileModel;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Interface FileStorageRepositoryInterface
 *
 * @package App\Repositories
 */
interface FileStorageRepositoryInterface
{
    /**
     * @param string $storageType
     *
     * @return void
     */
    public function setStorage(string $storageType): void;

    /**
     * @param FileModel $fileModel
     * @param UploadedFile $file
     *
     * return void
     */
    public function put(FileModel $fileModel, UploadedFile $file): void;

    /**
     * @param FileModel $fileModel
     * @param string $extension
     *
     * @return StreamedResponse
     */
    public function download(FileModel $fileModel, string $extension): StreamedResponse;
}
