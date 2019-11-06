<?php

declare(strict_types = 1);

namespace App\Repositories;

use App\Models\File as FileModel;
use Illuminate\Http\UploadedFile;

/**
 * Interface FileRepositoryInterface
 *
 * @package App\Repositories
 */
interface FileRepositoryInterface
{
    /**
     * @param UploadedFile $file
     *
     * @return FileModel
     */
    public function store(UploadedFile $file): FileModel;

    /**
     * @param FileModel $fileModel
     *
     * @return void
     */
    public function setConvertedStatus(FileModel $fileModel): void;

}
